rm(list = ls())
library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/2016_Questionnaire_1_cleaned.sav"))
# Filter large weights
dat <- subset(dat, Weight < 150)
# Overall mean
mean(dat$Weight) # 63.04746
# Factor labels
levels(dat$Gender) <- c("Female", "Male")
# Mean(Male)
mean(dat$Weight[dat$Gender == "Male"])    # 71.5
# Mean(Female)
mean(dat$Weight[dat$Gender == "Female"])  # 58.53944
# ALso use aggregate function
aggregate(Weight ~ Gender, FUN = mean, data = dat)
# Gender   Weight
# 1 Female 58.53944
# 2   Male 71.50000

# Dummy predictor: 0 = Males, 1 = Females
# Weight = B(0) + B(1)dummy + error    >>> Dummy effect = significant? 
# Create dummy variable
dat$dummy <- NA
dat$dummy[dat$Gender == "Male"] <- 0
dat$dummy[dat$Gender == "Female"] <- 1
# Estimate model: 
mod_dummy <- lm(Weight ~ dummy, data = dat)
summary(mod_dummy)
# Weight = 71.5 - 12.961(dummy) + error
#                   signif.
# Intercept = Mean(Male) as when dummy = 0 is for Males. 
# Slope-B(1) = Difference between Mean(Female) and Mean(Male) >>> 58.539 - 71.5 = -12.961

# Effect predictor: -1 = Males, +1 = Females (Effect coding: -1 for reference group)
# Weight = B(0) + B(1)effect + error    >>> effect = significant?
dat$effect <- dat$dummy
dat$effect[dat$Gender == "Male"] <- -1
# Estimate model:
mod_effect <- lm(Weight ~ effect, data = dat)
summary(mod_effect)
# Weight = 65.0197 - 6.4803(effect) + error
#                       signif. 
# Intercept: Avg. of c(Male mean and Female mean) >>> (58.539  + 71.5) / 2 
# Slope: Half the difference between Mean(Female) and Mean(Male) >>> (58.539 - 71.5) / 2 = -6.4803
# Orthogonal contrast... 

# Effect2 predictor: -0.5 = Males, +0.5 = Females. 
# Weight = B(0) + B(1)effect2 >>> effect2 = significant? 
dat$effect2 <- dat$effect/2
# Estimate model:
mod_effect2 <- lm(Weight ~ effect2, data = dat)
summary(mod_effect2)
# Weight = 65.0197 - 12.9606(effect2) + error
#                       signif. 
# Intercept: Avg. of c(Male mean and Female mean) >>> (58.539 + 71.5) / 2 
# Slope: Difference between Mean(Female) and Mean(Male) >>> 58.539 - 71.5 = -12.961

# F-value of dummy, effect, effect2: t(-6.963)^2 >>>  48.48337

rm(list = ls())
# ANOVA: Test significant differences between designs. 
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/WebDesign.sav"))
# Factor labels
levels(dat$design) <- c("Avery", "Bode", "Creevey")
web_aov <- aov(time ~ design, data = dat)
summary(web_aov)
# F(2,24) = 7.289, p = 0.003 < alpha = 0.05 >>> significant difference between designs
# Tukey's HSD
TukeyHSD(web_aov)
# difference between Design B and Design C. 
# Dummy code for Design
dat$dummy1 <- 0
dat$dummy1[dat$design == "B"] <- 1
dat$dummy2 <- 0
dat$dummy2[dat$design == "C"] <- 1
mod_web <- lm(time~design, data = dat)
summary(mod_web)
# F(2,24) = 7.289, p = 0.003  >>> same as ANOVA
# Correlation between dummy variables?
cor(dat[, c("dummy1", "dummy2")])


# Age on Memory
library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/AgeMemory.sav"))

# Helmert Contrast codes
dat$helmert1 <- -1
dat$helmert1[dat$age == 30] <- 3
dat$helmert2 <- 0
dat$helmert2[dat$age == 40] <- 2
dat$helmert2[dat$age > 40] <- -1
dat$helmert3 <- 0
dat$helmert3[dat$age == 50] <- 1
dat$helmert3[dat$age > 50] <- -1
# Estimate model
mod_age_helmert <- lm(score ~ helmert1 + helmert2 + helmert3, data = dat)
summary(mod_age_helmert)
# Score = 12.4583 + 0.3472(helmert1) + 0.8611(helmert2) + 2.4167(helmert3) + error
#                     not signif.         ...signif.        signif**
# R^2 = 0.4432, F(3,20) = 5.306, p = 0.007. 
# Only individual effect of X(3) is significant, showing significant difference in scores between 50 vs. 60 year olds

# Contrast: 30 years 40 years 50 years 60 years
# B1           3       -1        -1      -1
# B2           0        2        -1      -1
# B3           0        0         1      -1

# PRE
# SS terms
tmp <- anova(lm(score~1, data = dat), mod_age_helmert)
tmp    
PRE <- tmp$"Sum of Sq"[2]/tmp$RSS[1]
PRE # 0.4431798
# Unbiased estimate (^n^2)
1-((1-PRE)*(24-1))/(24-4)    # 0.3596568

# Polynomial Contrast code 
dat$poly1 <- dat$poly2 <- dat$poly3 <- NA
# Linear contrast
dat$poly1[dat$age == 30] <- -3
dat$poly1[dat$age == 40] <- -1
dat$poly1[dat$age == 50] <- 1
dat$poly1[dat$age == 60] <- 3

# Quadratic contrast
dat$poly2[dat$age == 30] <- 1
dat$poly2[dat$age == 40] <- -1
dat$poly2[dat$age == 50] <- -1
dat$poly2[dat$age == 60] <- 1

# Cubic contrast
dat$poly3[dat$age == 30] <- -1
dat$poly3[dat$age == 40] <- 3
dat$poly3[dat$age == 50] <- -3
dat$poly3[dat$age == 60] <- 1

# Estimate model
mod_age_poly <- lm(score ~ poly1 + poly2 + poly3, data = dat)
summary(mod_age_poly)
# Score = 12.4583 - 0.7083(Linear) - 1.2917(Quadratic) - 0.2083(Cubic) + error
#                     signif**          signif*           NOT signif. 

# Set up of contrast codes: contrasts() function, extract using model.matrix() function
dat$age_factor <- factor(dat$age)
contrasts(dat$age_factor) <- cbind(c(-3,-1,1,3), c(1,-1,-1,1), c(-1,3,-3,1))
poly_contrast <- model.matrix(score~age_factor, data = dat)
head(poly_contrast)

# Assign multiple variables in dat simultaneously
dat[, c("poly1", "poly2", "poly3")] <- poly_contrast[, 2:4]
str(poly_contrast)
dimnames(poly_contrast)

summary(lm(score ~ poly1 + poly2 + poly3, data = dat))
# Should be same as above. 
# Score = 12.4583 - 0.7083(Linear) - 1.2917(Quadratic) - 0.2083(Cubic) + error

# Contrast: 30 years 40 years 50 years 60 years
# B1          -3      -1        1         3
# B2           1      -1       -1         1
# B3          -1       3       -3         1
# R^2 = 0.4432, F(3,20) = 5.306, p = 0.007
# Linear = significant, Quadratic = significant, Cubic = NOT significant

# Comparison with Age as metric variable in linear regression model, comparison with polynomial contrast analysis.
mod_age_linear <- lm(score ~ age, data = dat)
summary(mod_age_linear)
# Score = 18.83 - 0.1417(Age) + error
#                   signif*
# R^2 = 0.253, F(1,22) = 7.452, p = 0.01223
# Test result different as in polynomial = inclusion of quadratic and cubic contrasts in model.
# SSE in polynomial model < SSE of Linear RM. 
# Different slope due to different scalor (+2 vs. +10)

rm(list = ls())
# 4. Learning interference with memory
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/LearnMemory.sav"))
# reptn: numeric >>> factor
dat$reptn <- factor(dat$reptn)
class(dat$reptn)
library(car)
aov_learn <- aov(recall ~ other*reptn, data = dat)
# Type III ANOVA
Anova(aov_learn, type = "III")
# Plot interaction
interaction.plot(dat$reptn, dat$other, dat$recall, type = "b")

summary(aov_learn)
# Df Sum Sq Mean Sq F value   Pr(>F)    
# other        1 121.00  121.00  41.407 4.16e-07 ***
# reptn        2 176.17   88.08  30.143 6.65e-08 ***
# other:reptn  2  35.17   17.58   6.017  0.00635 ** 
# Residuals   30  87.67    2.92                     
#                                                   
# Difference in means of other material between numbers vs. syllables
# Difference in means of repetitions between (at least) 4 vs. 8 vs. 12 reps
# Interaction between other material & repetitions: differences in means of repetitions for numbers vs. syllables (vice-versa)


# Analysis in Regression - Specify main effect and interaction effect
contrasts(dat$other) <- c(-1,1)
contrasts(dat$reptn) <- cbind(c(-1,0,1),
                              c(-1,2,-1))
dat[, c("c_other", "lin_rep", "quad_rep", "other_lin", "other_quad")] <-
  model.matrix(recall ~ other*reptn, data = dat)[, 2:6]
mod_learn <- lm(recall ~ c_other + lin_rep + quad_rep + other_lin + other_quad, data = dat)
summary(mod_learn)
#
#
#
#
#

# Omnibus tests
# Main effect of 'other'
anova(update(mod_learn, .~. - c_other), mod_learn)
# F = 41.407, p = 0.0000004163

# Main effect of 'repetition' (reptn)
anova(update(mod_learn, .~. - lin_rep - quad_rep), mod_learn)
# F = 30.143, p = 0.00000006646

# Interaction effect of 'other'
anova(update(mod_learn, .~. - other_lin - other_quad), mod_learn)
# F = 6.0171, p = 0.00635

anova(mod_learn)
interaction.plot(dat$lin_rep, dat$other, dat$recall, type = "b")
interaction.plot(dat$quad_rep, dat$other, dat$recall, type = "b")
?interaction.plot


