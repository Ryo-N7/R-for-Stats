library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/2016_Questionnaire_1_cleaned.sav"))
summary(dat)
# Standard deviations
apply(dat[, c("Age", "Height", "Weight")], 2, sd)
# Age: 4.847155
# Height: 8.626949
# Weight: 17.358501

# Histograms
hist(dat$Age)
hist(dat$Height)
hist(dat$Weight)
# Scatterplots
plot(dat$Age, dat$Weight)
plot(dat$Height, dat$Weight)
plot(dat$Age, dat$Height)

# Remove outliers
cdat <- subset(dat, !is.na(Weight) & Weight < 120 | !is.na(Height) & Height < 140 | !is.na(Weight) & Weight < 140)
plot(cdat$Age, cdat$Weight)
plot(cdat$Age, cdat$Height)
hist(cdat$Weight)
hist(cdat$Height)

# Weight = B(0) + B(1)Height + B(2)Age + error
mod <- lm(Weight ~ Height + Age, data = cdat)
summary(mod)

# Predicted vs. Residuals plot
plot(predict(mod), residuals(mod))
abline(h = 0, col = "blue")
# Histogram of residuals
hist(residuals(mod), prob = TRUE)
curve(dnorm(x, mean = 0, sd = sd(residuals(mod))), add = TRUE)

# QQ Plot
qqnorm(residuals(mod))
qqline(residuals(mod), col = 2)
?qqnorm

# Normality tests
# Shapiro-Wilks Test
shapiro.test(residuals(mod))
# W = 0.86957, p-value = 1.129e^-09, REJECT NULL, data NOT normal distribution! 

# Kolmogorov-Smirnov Test
ks.test(residuals(mod), "pnorm", mean = 0, sd = sd(residuals(mod)))
# D = 0.12286, p-value = 0.03104, REJECT NULL, data NOT normal distribution! 

# Multicollinearity? 
vif(mod)
remove.packages("VIF")
library(VIF)
?vif
vif(residuals(mod))
install.packages("car")
library(car)
vif(mod)
# Height: 1.012494, Age: 1.012494 >>> NO COLLINEARITY! 

# Outlier detection: 
# Mahalanobis distance
predictions <- as.matrix(cdat[, c("Height", "Age")])
Mahal <- mahalanobis(predictions, colMeans(predictions), cov(predictions)) 
which(Mahal >= qchisq(1-0.05/nrow(cdat), df = 2))
# 17, 114, 17, 113 >>> remove calculated points from data sample

# Leverage
lever <- hatvalues(mod)
which(lever > (2*3)/nrow(cdat))

# Studented Deleted Residuals
sdr <- rstudent(mod)
which(abs(sdr) >= qt(1-(0.05/2)/ nrow(cdat), df = nrow(cdat) - 3 - 1))

# Cook's Distance
cooksd <- cooks.distance(mod)
which(cooksd > 1)
# NONE! 




rm(list = ls())

# 2. Reaction time & IQ
library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/reactionIQ.sav"))
modc <- lm(RT ~ AH4, data = dat)
summary(modc)
# RT = 834.2973 - 3.8537(AH4) + error
#                   signif. 

# SSE(C)
SSEC <- sum(residuals(modc)^2)
SSEC   # 9067692


# Polynomial regression: AH^2
dat$AH4sq <- dat$AH4^2
modA <- lm(RT ~ AH4 + AH4sq, data = dat)
summary(modA)
# RT = 865.96919 - 6.62487(AH4) + 0.04911(AH4^2) + error
#                    signif          signif**

# SSE(A)
SSEA <- sum(residuals(modA)^2)
SSEA   # 8983902

# PRE
PRE <- (SSEC - SSEA) / SSEC
PRE      # 0.00924

# ANOVA
anova(modc, modA)
# F(2,897), p = ~0.04, REJECT NULL, addition of AH4^2 is significant effect on RT

# Remove Outliers

# Studentized Deleted Residual
sdr <- rstudent(modA)
which(abs(sdr) >= qt(1-(0.001/2), df = nrow(dat)-3-1))
# 34, 40, 42, 43, 87

# Cook's Distance
cooksd <- cooks.distance(modA)
which(cooksd > 1)
# 0

cleandat <- dat[abs(sdr) < qt(1-(0.001/2), df = nrow(dat)-3-1) & cooksd < 1, ]
modAA <- lm(RT~AH4+AH4sq, data = cleandat)
summary(modAA)
# RT = 874.74741 - 7.20342(AH4) + 0.05756(AH4^2) + error
#                     signif.           signif. 

# Residuals
RTres <- residuals(modAA)
sum(RTres^2)

# Histogram of Residuals
hist(RTres, prob = TRUE)
curve(dnorm(x, mean = 0, sd = sd(RTres)), add = TRUE)
# QQ Plot of Residuals
qqnorm(RTres)
qqline(RTres, col = 5)

plot(predict(modAA), residuals(modAA))
abline(h = 0, col = "blue")
# Normality can be assumed from QQ plot and histogram, 
# some problems appear in predicted/residual plot as 
# higher values of RT seem to have higher variance (heterogeneity)

# Shapiro-Wilks Test
shapiro.test(RTres)   # w = 0.99849, p = 0.6413, FAIL TO REJECT, normal distribution holds. 

# Breusch-Pagan Test
# Calculate SSR(Y)
SSRY <- sum(residuals(lm(RT~1, data = cleandat))^2) - sum(residuals(modAA)^2)
SSRY   # 2145532
# Computer 'g'
cleandat$g <- RTres^2/(SSRY/nrow(cleandat))
gmod <- lm(g~AH4 + AH4sq, data = cleandat)
summary(gmod)
# g = 10.9582609 - 0.463869(AH4) + 0.006(AH4^2) + error
#                   signif.           signif. 
# SSR(g) for B-P Test
SSRg <- sum(residuals(lm(g~1, data = cleandat))^2) - sum(residuals(gmod)^2)
SSRg/2    # 1547.14
# P-value:
1 - pchisq(SSRg/2, df = 2)   # 0 
# According to B-P Test, significant = REJECT NULL, heteroskedasticity present. 

# Koenker Test
Rsq_g <- SSRg/sum(residuals(lm(g~1, data = cleandat))^2)  # R^2: 0.111
nrow(cleandat)*Rsq_g # Koenker Test-statistic: 99.36931
# P-value: 
1 - pchisq(nrow(cleandat)*Rsq_g, df = 2)     # 0 
# According to B-P Test, significant = REJECT NULL, heteroskedasticity present. 



# log(RT), transforming DV. 
dat$logRT <- log(dat$RT)
modlog <- lm(logRT~AH4, data = dat)
summary(modlog)
# logRT = 6.7159 - 0.00495(AH4) + error
#                    signif.
modlog2 <- update(modlog, .~.+AH4sq)
summary(modlog2)
# logRT = 6.738 - 0.006915(AH4) + 0.00003474(AH4^2) + error
#                   signif.         NOT signif. 
# Quadratic effect AH4^2 is NOT significant, NOT include in model. 

# Remove outliers
sdrlog <- rstudent(modlog)
which(abs(sdrlog) > qt(1-0.001/2, df = nrow(dat)-2-1))
# 40, 42, 87, 98, 692

cooksdlog <- cooks.distance(modlog)
which(cooksdlog > 1)   # 0 

cleandatlog <- dat[abs(sdr) < qt(1-0.001/2, df = nrow(dat)-2-1) & cooksdlog < 1, ]
modlogclean <- lm(logRT~AH4, dat = cleandatlog)
summary(modlogclean)
# logRT = 6.7235 - 0.005(AH4) + error
#                   signif. 

summary(update(modlogclean, .~. + AH4sq))
logRT = 6.759 - 0.008286(AH4) + 0.00005459(AH4^2) + error
#                 signif.             signif*
# Quadratic effect = significant, include in model

# Residuals
modlogclean2 <- lm(logRT~ AH4 + AH4sq, dat = cleandatlog)
logRTres <- residuals(modlogclean2)

# Histogram
hist(logRTres, prob = TRUE)
curve(dnorm(x, mean = 0, sd = sd(logRTres)), add = TRUE)
# QQ plot
qqnorm(logRTres)
qqline(logRTres, col = 5)
# Predicted/Residual plot
plot(predict(modlogclean2), residuals(modlogclean2))
abline(h = 0, col = "blue")
# QQ and histogram show normality, predicted/residual show improvement in heterogeneity. 

# Shapiro-Wilks Test
shapiro.test(logRTres)
# w = 0.99214, p = 0.0001093, REJECT NULL, NOT normal distribution.

# Breusch-Pagan Test
SSRYlog <- sum(residuals(lm(logRT~1, data = cleandatlog))^2) - sum(residuals(modlogclean2)^2)
# Compute 'g'
cleandatlog$glog <- logRTres^2/(SSRYlog/nrow(cleandatlog))
gmodlog <- lm(glog~AH4+AH4sq, data = cleandatlog)
summary(gmodlog)
# log('g') = 9.655621 - 0.369589(AH4) + 0.005116(AH^2) + error
#                         signif.           signif. 
SSRglog <- sum(residuals(lm(g~1, data = cleandatlog))^2) - sum(residuals(gmodlog)^2)
SSRglog/2      # 853.6735
# P-value
1-pchisq(SSRglog/2, df = 2)    # 0 
# Significant, REJECT NULL, heteroskedasticity present. 

# Koenker Test
Rsq_glog <- SSRglog/sum(residuals(lm(g~1, data = cleandatlog))^2)   # R^2: 0.049613
nrow(cleandatlog)*Rsq_glog # Koenker statistic: 44.40435
1-pchisq(nrow(cleandatlog)*Rsq_glog, df = 2)   # P-value: 0.0000000000227
# Significant, REJECT NULL, heteroskedasticity present. 
# Lowered heteroskedasticity but necessity search for other transformations of variables to attempt elimination. 

library(car)
1/vif(gmodlog)


# 3. 
rm(list = ls())

library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/mystery.sav"))
mod <- lm(y ~ x1 + x2, data = dat)
summary(mod)
# y = 0.68142 + 0.49918(x1) + 0.86442(x2) + error
#                  signif.       signif. 
# R^2: 0.9742

# Histogram
hist(residuals(mod), prob = TRUE)
curve(dnorm(x, mean = 0, sd = sd(residuals(mod))), add = TRUE)    # NOT normal distribution
# QQ Plot
qqnorm(residuals(mod))
qqline(residuals(mod), col = 4)       # NOT normal distribution
# Predict/Residual plot
plot(predict(mod), residuals(mod))
abline(h = 0, col = "red")

# Shapir-Wilks Test
shapiro.test(residuals(mod))
# w = 0.76823, p = 0.0003, REJECT NULL, NOT normal distribution

# Non-linearity?
plot(y~x1, data = dat)
plot(y~x2, data = dat)
# most likely linear...

# TRUE MODEL = Pythagorean Theorem! 
# ?I() : transform variables without storing them in environment
truemod <- lm(I(y^2) ~ I(x1^2) + I(x2^2), data = dat)
summary(truemod)
# Y^2 = -0.418815 + 1.013(X1^2) + 1.00(X2^2) + error
# R^2 = 1.00
# Histogram
hist(residuals(truemod))
curve(dnorm(x, mean = 0, sd = sd(residuals(truemod))), add = TRUE)
# QQ Plot
qqnorm(residuals(truemod))
qqline(residuals(truemod), col = 2)

# Predictor/Residual plot
plot(predict(truemod), residuals(truemod))
abline(h = 0, col = "blue")

# Shapiro-Wilks Test
shapiro.test(residuals(truemod))
# w = 0.91303, p = 0.07281, FAIL REJECT NULL, normality present.