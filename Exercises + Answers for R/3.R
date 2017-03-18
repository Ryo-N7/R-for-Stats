library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/2016_Questionnaire_1_cleaned.sav"))
summary(dat[,c("Height", "Weight", "Age")])

# Standard deviation
sd(dat$Height)
# SD(Height) = 8.626949
sd(dat$Weight)
# SD(Weight) = 17.3585
sd(dat$Age)
# SD(Age) = 4.847155
# Alternatively...
apply(dat[, c("Height", "Weight", "Age")], 2, sd)

# Histograms
hist(dat$Age)
hist(dat$Weight)
hist(dat$Height)

# Scatterplots
plot(dat$Age, dat$Height)
plot(dat$Height, dat$Weight)
plot(dat$Age, dat$Weight)

# Regression Models
# Height on Weight:
mod <- lm(Weight ~ Height, data = dat)
summary(mod)
# Weight = -82.4739 + 0.8645(Height) + error
#           (signif)    (signif)
# F(1,138) = 31.23, p = 1.182e^-07
# REJECT NULL, Height is related to Weight (every 1cm increase in Height is +0.8654kg in Weight)
# Height explains ~18% of the variance in Weight

# Age on Weight:
mod2 <- lm(Weight ~ Age, data = dat)
summary(mod2)
# Weight = 52.873 + 0.4684(Age) + error
#           (signif)  (NOT signif)
# F(1,138) = 2.402, p = 0.1235
# FAIL TO REJECT NULL, Age effect on Weight is insignificant
# Age explains ~2% of the variance in Weight

# Height and Age on Weight
mod3 <- lm(Weight ~ Age + Height, data = dat)
summary(mod3)
# Weight = -86.9755 + 0.3070(Age) + 0.8479(Height) + error
#           (signif)    (NOT signif)     (signif)
# F(2, 137) = 16.26, p = 4.626e^-07
# Age is NOT significant with p = 0.26905, Height is significant with p = 2.36e^-07
# Age and Height explain 19% of the variation in weight (mostly Height). 

# Predicting level of eating disorder
geller <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/Geller.sav"))
mod <- lm(edicomp ~ rses + bdi + bmi, data = geller)
summary(mod)
# EDIcomp = 13.5664 - 0.6801(rses) + 1.0759(bdi) + 1.0194(bmi) + error
#                     (signif)        (signif)      (signif)     

# SSE(A)
SSEA <- sum(residuals(mod)^2)
SSEA
# SSE(C)
SSEC <- sum(residuals(lm(edicomp~1, data = geller))^2)
SSEC
# PRE
(SSEC-SSEA)/(SSEC)
# 0.5747384

# Model C
modC <- mod
# Add new predictor sawbs
modA1 <- update(modC, .~. + sawbs)
summary(modA1)
# EDIcomp = 11.38826 - 0.59457(rses) + 0.80572(bdi) + 0.76236(bmi) + 0.13044(sawbs) + error
#                       (signif*)        (signif**)      (signif*)     (signif)
# SSEA1
SSEA1 <- sum(residuals(modA1)^2)
# 8371.055
# PRE
(SSEC - SSEA1)/(SSEC)
# 0.67

# Hypothesis test:
anova(modC, modA1, test = "F")
# F(1, 79) = 23.013, p = 7.457e^-06, significant = REJECT NULL, sawbs != 0 

# Add new perdictor wtpercep & shpercep
modA2 <- update(modA1, .~. + wtpercep + shpercep)
summary(modA2)
#EDIcomp = 68.91 - 0.51(rses) + 0.466(bdi) - 0.272(bmi) + 0.100(sawbs) - 4.91(wtpercep) - 4.07(shpercep) + error
#                   (signif*)   (signif.)     (NOTsignif)   (signif)        (signif*)       (signif)
# SSEA2
SSEA2 <- sum(residuals(modA2)^2)
# 6186.892
# PRE
(SSEC - SSEA2)/(SSEC)
# 0.756

# Hypothesis test: inclusion of wtpercep & shpercep significantly reduce SSE from A1? 
anova(modA1, modA2, test = "F")
# F(2,77) = 13.592, p = 8.803e^-06, significant = REJECT NULL, significant reduction in error from inclusion
# PRE: (8371.1-6186.9)/(8371.1) = 0.26, error reduced by 26.1% by inclusion wtpercep & shpercep

library(MASS)
mod0 <- lm(hiq~1, data = geller)
#Forward
forwardmod <- stepAIC(mod0, scope = ~wtpercep + shpercep + rses + bdi + bmi + ses +socdesir, direction = "forward")
summary(forwardmod)
#Backward
backwardmod <- stepAIC(lm(hiq ~ wtpercep + shpercep + rses + bdi + bmi + ses + socdesir, data = geller), direction = "backward")
summary(backwardmod)
#Step-wise
stepwisemod <- stepAIC(mod0, scope = ~wtpercep + shpercep + rses + bdi + bmi + ses +socdesir, direction = "both")
summary(stepwisemod)
