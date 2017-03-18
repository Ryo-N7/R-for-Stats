rm(list = ls())
library(foreign)
geller <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/geller.sav"))
ModelC <- lm(hiq ~ rses + sawbs, data = geller)
summary(ModelC)
# HIQ = 29.29943 - 0.48769(rses) + 0.0878(sawbs) + error
#                   signif.         signif.       
# SSE(C)
SSEC <- sum(residuals(ModelC)^2)    # 3137.012

# Model A1: with interaction of RSES*SAWBS
ModelA1 <- lm(hiq ~ rses + sawbs +(rses:sawbs), data = geller)    
# or lm(hiq ~ rses*sawbs, data = geller) for simple slopes AND interaction
summary(ModelA1)
# HIQ = 31.11 - 0.536(rses) + 0.062(sawbs) + 0.000734(rses*sawbs) + error
#                 signif.         NOT signif        NOT signif
# SSE(A1) 
SSEA1 <- sum(residuals(ModelA1)^2)  # 3128.757

# Comparing Model C to Model A1, Hypothesis: B(3) = 0     B(3) is the interaction term. 
anova(ModelC, ModelA1)
# F(2,80) = 0.2111, p = 0.6472, FAIL TO REJECT, insignificant, NO significant effect of interaciton


# Correlations
geller$rses_sawbs <- geller$rses*geller$sawbs
cor(geller[, c("rses", "sawbs", "rses_sawbs")])
#                   rses      sawbs  rses_sawbs
# rses        1.00000000 -0.3782735 -0.04348224
# sawbs      -0.37827350  1.0000000  0.90549922
# rses_sawbs -0.04348224  0.9054992  1.00000000

# model.matrix function for correlations
?model.matrix

# significant moderate negative correlation between SAWBS and RSES (r = - 0.378)
# high correlation between SAWBS and interaction (r = 0.905)

# Centering predictors
?scale
geller$rses0 <- scale(geller$rses, center = TRUE, scale = FALSE)
geller$sawbs0 <- scale(geller$sawbs, scale = FALSE)
ModelA2 <- lm(hiq ~ rses0*sawbs0, data = geller)
summary(ModelA2)
# HIQ = 16.904 - 0.494(rses0) + 0.0886(sawbs0) + 0.000734(rses0*sawbs0) + error
#                  signif.       signif.            NOT signif. 
# Centering means predictors have value of 0 when at Mean values. 
# Slope of predictors in interaction model are slopes when other predictors = 0. 
# SAWBS now significant effect on HIQ when RSES at Mean value whereas 
# NO significant effect of SAWBS on HIQ when RSES = 0. 

# Correlation:
cor(model.matrix(ModelA2) [,2:4])
#                   rses0     sawbs0 rses0:sawbs0
# rses0         1.0000000 -0.3782735    0.2102434
# sawbs0       -0.3782735  1.0000000   -0.1841580
# rses0:sawbs0  0.2102434 -0.1841580    1.0000000
# Correlation between SAWBS and RSES = no change. Correlation between SAWBS and interaction = SMALLER.
# Centering reduces multicollinearity by having each predictor have both positive and negative values. 

# 2. Effect of wtpercep and shpercep on Eating Disorders (as measured by HIQ) = mediated by self-esteem?
geller$WSPercep <- rowMeans(geller[, c("wtpercep", "shpercep")])

# Causal Steps Procedure
Model1 <- lm(hiq ~ WSPercep, data = geller)
summary(ModelA3)
# HIQ = 41.6937 - 6.728(WSPercep) + error
#                   signif. 
#                 F = 52.9
Model2 <- lm(rses ~ WSPercep, data = geller)
summary(Model2)
# RSES = 19.7249 + 4.3987(WSPercep) + error
#                      signif. 
#                   
Model3 <- lm(hiq ~ WSPercep + rses, data = geller)
summary(Model3)
# HIQ = 50.6493 - 4.7309(WSPercep) - 0.454(RSES) + error
#                     signif.         signif.   
#                   F = 26.24, F-stat in Model 3 < F(Model 1) 
# Conclusions:
# Effect of Wtpercep and Shpercep NOT completely mediated by self-esteem >>> Partial mediation present. 

# Sobel-Aroian Test for significance of indirect effect of WSPercep on HIQ
mySobelTest <- function(a,b,se_a,se_b) {
  Z <- (a*b)/sqrt((a^2 * se_b^2 + b^2 * se_a^2 + se_a^2 * se_b^2))
  # two-sided p-value
  p <- 2*(1-pnorm(abs(Z)))
  cat("Sobel-Aroian Test")
  cat(paste(" Z = ", Z, ", p = ", sep = " "))
}


a <- summary(Model2)$coefficients["WSPercep", "Estimate"]
se_a <- summary(Model2)$coefficients["WSPercep", "Std. Error"]
b <- summary(Model3)$coefficients["rses", "Estimate"]
se_b <- summary(Model3)$coefficients["rses", "Std. Error"]

mySobelTest(a, b, se_a, se_b)
# Z = -3.2777, p = 0.001 < alpha = 0.05, mediated effect of WSPercep on HIQ via rses = SIGNIFICANT

# Another mediated effect: Social desireability effect on Eating Disorders mediated by depression? 

summary(lm(hiq ~ socdesir, data = geller))
# HIQ = 24.908 - 1.62(socdesir) + error
#                 error

summary(lm(bdi ~ socdesir, data = geller))
# BDI = 16.44 - 1.188(socdesir) + error
#                 signif**

summary(lm(hiq ~ socdesir + bdi, data = geller))
# HIQ = 12.3511 - 0.7142(socdesir) + bdi(0.7638) + error
#                   ...signif...          signif.

# Improved 'R' formula for Sobel-Aroian
simpleSobelTest <- function(source, mediator, dependent) {
  # Fit Model 2
  mod <- lm(mediator ~ source)
  a <- summary(mod)$coefficients["source", "Estimate"]
  se_a <- summary(mod)$coefficients["source", "Std. Error"]
  # Fit Model 3
  mod <- lm(dependent ~ source + mediator)
  b <- summary(mod)$coefficients["mediator", "Estimate"]
  se_b <- summary(mod)$coefficients["mediator", "Std. Error"]
  Z <- (a*b)/sqrt((a^2 * se_b^2 + b^2 * se_a^2 + se_a^2 * se_b^2))
  # 2-sided p-value
  p <- 2*(1-pnorm(abs(Z)))
  result <- list(
    "Z" = Z, 
    "P-value" = p
  )
  cat("Sobel-Aroian Test")
  cat("Path:", deparse(substitute(source)), "-->",
      deparse(substitute(mediator)), "-->",
      deparse(substitute(dependent)), " ")
  cat("a * b = ", a*b, " ")
  cat(paste("Z = ", signif(Z, 3), ", p = ", signif(p, 3), " ", sep = " "))
  return(result)}

# Conclusion: 
# SocDesir significant in Model 1, Model 2, however NOT significant in Model 3.
# BDI significant in Model 3
# Evidence of SocDesir effect on HIQ is COMPLETELY mediated by BDI. 

simpleSobelTest(source = geller$socdesir, mediator = geller$bdi, dependent = geller$hiq)
# Path: Socdesir > BDI > HIQ
# Z = -2.85555, p = 0.0043 < alpha = 0.05, mediated effect of depression on SocDesir on HIQ = SIGNIFICANT
















