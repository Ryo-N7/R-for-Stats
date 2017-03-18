rm(list = ls())
library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/RoleTaking.sav"))
# Contrast code for "Daycare"
dat$c_daycare <- -1
dat$c_daycare[dat$Daycare == "Daycare"] <- 1
# Contrast code for "Age"
dat$c_age <- -1
dat$c_age[dat$Age == "Older"] <- 1
# Contrast code for interaction
dat$c_dayage <- dat$c_daycare * dat$c_age

# Contrasts
# No Daycare          Daycare
# Younger Older   Younger Older
# B1 -1   -1        1       1
# B2 -1    1       -1       1
# B3  1   -1       -1       1


# Estimate model (Type III SS)
mod <- lm(Score ~ c_daycare + c_age + c_dayage, data = dat)
summary(mod)
# Score = -0.27838 + 0.28858(Daycare) + 0.60763(Age) - 0.03433(Daycare*Age) + error
#                     signif*             signif.           NOT signif. 
# Conclusions: 
# main effect of daycare (F = ~4, p= 0.041), actual difference between avg. of groups = (2*-.289 = 0.578)
# main effect of age
# interaction effect = NOT significant

# Correlations
cor(dat[, c("c_daycare", "c_age", "c_dayage")])
# c_daycare      c_age   c_dayage
# c_daycare  1.0000000 -0.1711842 -0.2423202
# c_age     -0.1711842  1.0000000 -0.3282440
# c_dayage  -0.2423202 -0.3282440  1.0000000
# Low correlation for each of the contrast codes (orthogonal)
# Tolerance
library(car)
1/vif(mod)
# c_daycare     c_age  c_dayage 
# 0.8708273 0.8254717 0.8004574
# some ~multicollinearity



# Sequential SS Procedure (Type I)
# A(1) Age > (A2) Daycare > A(3) interaction Age*Daycare

mod_c <- lm(Score ~ 1, data = dat)
mod_A1 <- lm(Score ~ c_age, data = dat)
summary(mod_A1)
# Score = -0.3689 + 0.571(Age) + error
#                     signif. 
# Model comparison:
anova(mod_c, mod_A1)
# Res.Df    RSS Df Sum of Sq      F    Pr(>F)    
# 1     39 36.778                                  
# 2     38 24.258  1    12.519 19.611 7.771e-05 *** 
# SSR = 36.778(SSE-C) - 24.258(SSE-A1) >>> 12.52
# Alternate: Extract RSS
SSR_age <- anova(mod_c, mod_A1)$"Sum of Sq"[2] # SSR_Age = 12.52

mod_A2 <- lm(Score ~ c_age + c_daycare, data = dat)
summary(mod_A2)
# Score = -0.269 + 0.6209(Age) + 0.2996(Daycare) + error
#                     signif.         signif*
# Model comparison
anova(mod_A1, mod_A2)
# Res.Df    RSS Df Sum of Sq      F  Pr(>F)  
# 1     38 24.259                              
# 2     37 21.087  1    3.1714 5.5646 0.02372 *
# SSR = 24.259(SSE-A1) - 21.087(SSE-A2) >>> 3.171
# Alternate: Extract RSS
SSR_daycare <- anova(mod_A1, mod_A2)$"Sum of Sq"[2] # SSR_daycare = 3.171
# Conclusion: adding in Daycare into model significantly decreases error (from 12.52 > 3.17)

mod_A3 <- lm(Score ~ c_age + c_daycare + c_dayage, data = dat)
summary(mod_A3)
# Score = -0.27838 + 0.60763(Age) + 0.28858(Daycare) - 0.034(Interaction) + error
#                     signif.           signif*           NOT signif. 
# Same as Type III procedure model (all predictors included)

# Model comparison
anova(mod_A2, mod_A3)
# Res.Df    RSS Df Sum of Sq      F Pr(>F)
# 1     37 21.087                           
# 2     36 21.050  1  0.037362 0.0639 0.8019
# SSR = 21.087(SSE-A2) - 21.05(SSE-A3) >>> 0.037
# Alternate: Extract RSS
SSR_dayage <- anova(mod_A2, mod_A3)$"Sum of Sq"[2] # SSR_dayage = 0.037

# Test for main effects using Model A3 and Type I SS procedure A1 and A2 models. 
SSE_A3 <- sum(residuals(mod_A3)^2)
# F-test for main effect of Age
F_age <- (SSR_age/(1-0))/(SSE_A3/(40-4))        # F_age = 21.41056
# P-value
1-pf(F_age, df1 = 1, df2 = 40-4)                # p = 0.00004666

# F-test for main effect of Daycare
F_daycare <-(SSR_daycare/(2-1))/(SSE_A3/(40-4)) # F_daycare = 5.423855
# P-value 
1-pf(F_daycare, df1 = 1, df2 = 40-4)            # p = 0.02559294

# F-test for interaction effect 
F_dayage <-(SSR_dayage/(3-2))/(SSE_A3/(40-4))   # F_dayage = 0.06389
# P-value 
1-pf(F_dayage, df1 = 1, df2 = 40-4)             # p = 0.8018747

# Conclusions:
# SSE(A3) < SSE of A2, A1 >>> ^powerful tests using SSE(A3)
# however, the smaller df2 in Model A3 attenuates ~increase in power gained

# Type I SS Sequential Procedure
# Different order: Daycare > Age > Interaction 
summary(aov(Score ~ c_daycare + c_age + c_dayage, data = dat))
# Daycare: F(1,36) = 2.257, p = 0.142, NOT significant
# Age: F(1,36) = 24.577, p = 0.0000171, signif.
# Interaction: F(1,36) = 0.064, p = 0.802, NOT significant
# Conclusions:
# When usage Type I sequential, ORDER of addition predictors = important for significance testing. 
# However, in Type I, the SSR terms add up to Total SSR (when comparing Model A3 to Model C). 
# When ALL predictors = orthogonal, NO difference between Type I vs. Type III SS tests. 


# 2. Sex differences in Weight -- controlling for differences in height
library(foreign)
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/2016_Questionnaire_1_cleaned.sav"))
# Filter outliers
dat <- subset(dat, Weight < 150)
# Dummy coding: Gender (Male = 1, Female = 0)
# Estimate: Weight = B(0) + B(1)dummyM + B(2)Height + B(3)dummyM*Height + error
levels(dat$Gender) <- c("Female", "Male")
dat$dummyM <- NA
dat$dummyM[dat$Gender == "Male"] <- 1
dat$dummyM[dat$Gender == "Female"] <- 0 
mod_dummy <- lm(Weight ~ dummyM*Height, data = dat)
summary(mod_dummy)
# Weight = -7.8 - 59.7557(dummyM) + 0.3984(Height) + 0.3892(dummyM * Height) + error
#                   NOT signif.       signif**            NOT signif. 
# Female Weight = -7.8 + 0.3894(Height) + error
# Male Weight = -67.557 + 0.787(Height) + error

# Center "Height" variable
dat$Height0 <- scale(dat$Height, scale = FALSE)
mod_dummy0 <- lm(Weight ~ dummyM*Height0, data = dat)
summary(mod_dummy0)
# Weight = 59.9307 + 6.4122(dummyM) + 0.3984(Height0) + 0.3892(dummyM * Height0) + error
#                       signif**        signif**            NOT signif. 
# Female Weight = 59.9307 + 0.398(Height0) + error
# Male Weight = 66.343 + 0.787(Height0) + error
# Conclusion:
# With centering, estimating the difference between males and females at the average height.
# More relevant than initial model which looks at the difference when height = 0. 
# Intercept: Avg. Weight of Females
# Slope: Differences in Weight between Males vs. Females avg. Height. 

# Effect coding for Gender. 
dat$effect <- NA
dat$effect[dat$Gender == "Male"] <- 1
dat$effect[dat$Gender == "Female"] <- -1
mod_effect0 <- lm(Weight ~ effect*Height0, data = dat)
summary(mod_effect0)
# Weight = 63.14 + 3.2061(effect) + 0.593(Height0) + 0.1946(effect * Height0) + error
#                   signif**          signif.           NOT signif. 
# Female Weight = 59.931 + 0.398(Height0) + error
# Male Weight = 66.343 + 0.787(Height0) + error
# Conclusion:
# Slope of Height0 change as now represent "average" effect of height over males and females. 
# (Main effect of height, controlling for gender) 
# Compared to people of average height in centered model. 
# Intercept: average weight for people of average height (Males vs. Females)
# Slope: differences in weight between Female vs. Males of avg. height




# 3. Hypnotic induction effectiveness, Method A or Method B? 
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/hypnosis.sav"))
# Helmert contrast coding
contrasts(dat$method) <- contr.helmert(2)
# Estimate model
summary(lm(y ~ method, data = dat))
# y = 28.65 - 0.55(MethodA) + error 
#               NOT signif. 
# F(1,18) = 0.1644, p = 0.6899, NOT significant, fail reject null. 
# NO general difference between hypnosis method A and B.

# Perform ANCOVA with "Primary Suggestability" as covariate.
summary(lm(y ~ method + x, data = dat))
# y = 15.7827 - 2.5773(MethodA) + 0.8275(PrimarySuggestability) + error 
#                 signif.               signif. 
drop1(lm(y ~ method + x, data = dat), test = "F")
# Primary Suggestability: F(1,17) = 75.074, p < 0.001, REJECT NULL, significant effect
# Method: F(1,17) = 16.025, p = 0.01, REJECT NULL, significant effect
# Method = significant as adding P-S reduces model error, allow effect of Method = ^clarity

# Contrast code METHOD
dat$c_method <- NA
dat$c_method[dat$method == "A"] <- -1
dat$c_method[dat$method == "B"] <- 1
# Estimate model
summary(lm(y ~ c_method + x, data = dat))
# y = 15.7827 - 2.5773(c_Method) + 0.8275(P-S) + error
#                 signif.             signif.
# Difference beween Method A vs. Method B = 2*-2.5773 = -5.154, Method B (+1) = 5.154 LOWER hypnotic score

# Test for homogeneity
dat$c_methodx <- dat$c_method*dat$x
# Estimate model
summary(lm(y ~ c_method + x + c_methodx, data = dat))
# y = 15.765 - 0.65696 (c_method) + 0.8485(P-S) - 0.12682(Interaction: Method*P-S) + error
#                 NOT signif.         signif.           NOT signif.
# Interaction effect: F(1,16) = 1.795, p = 0.199, NOT significant, fail to reject null
# Null of homogenous slopes = TRUE (relation between hypnotic induction and P-S = same between Method A and Method B)


# 4. Optimism and religious fundamentalism relationship. 
dat <- as.data.frame(read.spss("~/R materials/R for Stats/Dataset for R/FundOptim.sav"))
mod <- aov(Optim ~ Group, data = dat)
summary(mod)
#              Df Sum Sq  Mean Sq   F value   Pr(>F)    
# Group         2    385  192.48    19.92    4.23e-09 ***
# Residuals   597   5769    9.66
# Group: F(2,597) = 19.92, p = 0.00000000423, REJECT NULL, significant effect of group
# Tukey HSD
Tukey <- TukeyHSD(mod)
#                             diff       lwr      upr     p adj
# Moderate-Liberal        0.9630952 0.1661777 1.760013 0.0129546
# Fundamentalist-Liberal  2.1916667 1.3482884 3.035045 0.0000000
# Fundamentalist-Moderate 1.2285714 0.5523645 1.904778 0.0000678
plot(Tukey)
# Plot shows NONE of group differences (M-L, F-L, F-M) include 0. 
# Conclusion: ALL groups differ significantly from eachother. 

# Hypothesis: certain order of fundamentalism categories regards to optimism level >>> Polynomial contrast
contrasts(dat$Group) <- cbind("linear" = c(-1,0,1), "quadratic" = c(-1,2,-1))
#     Liberals Moderates Fundamentalists
# B1    -1        0           1
# B2    -1        2          -1

mod2 <- lm(Optim ~ Group, data = dat)
summary(mod2)
# Optim = 2.03492 + 1.095(Linear-Group) - 0.04425(Quadratic-Group) + error
#                       signif.               NOT signif.
# F test for main effect of GROUP on Optim
anova(lm(Optim ~ 1, data = dat), mod2)
# OR
summary(aov(Optim ~ Group, data = dat))
# Conclusions:
# Linear-Group: F(1,597) = 37.28, p = 0.00000000184, REJECT NULL, significant effect
# Quadratic-Group: F(1,597) = 0.264, p = 0.608, FAIL TO REJECT, NO significant effect
# In Linear relationship, difference between L-M = F-M. (both 1.096)


# Test RInfluen, RInvolve, RHope variables for effect on GROUP. >> polynomial contrast
summary(lm(RInfluen ~ Group, data = dat))
# RInfluen = 4.488 + 0.858(Linear-Group) - 0.1531(Quadratic-Group) + error
#                         signif.                 signif.
# Linear: F(1,597) = 169.149, p < 0.001, REJECT NULL, significant effect on GROUP
# Quadratic: F(1,597) = 23.405, p < 0.001, REJECT NULL, significant effect on GROUP
# Linear slope = POSITIVE, Influen increases with level of fundamentalism.
# Quadratic slope = NEGATIVE, Influen differences between M-L < differences between F-M 

summary(lm(RInvolve ~ Group, data = dat))
# RInvolve = 3.27 + 0.778(Linear-Group) + 0.1342(Quadratic-Group) + error
#                         signif.                 signif.
# Linear: F(1,597) = 124.324, p < 0.001, REJECT NULL, significant effect on GROUP
# Quadratic: F(1,597) = 16.06, p < 0.001, REJECT NULL, significant effect on GROUP
# Linear slope = POSITIVE, Involve increases with level of fundamentalism.
# Quadratic slope = POSITIVE, Involve effect PEAK in middle 
# --> difference between M-L > difference between F-M

summary(lm(RHope ~ Group, data = dat))
# RHope = 4.704 + 1.0367(Linear-Group) + 0.2013(Quadratic-Group) + error
#                       signif.                 signif.
# Linear: F(1,597) = 194.747, p < 0.001, REJECT NULL, significant effect on GROUP
# Quadratic: F(1,597) = 31.895, p < 0.001, REJECT NULL, significant effect on GROUP
# Linear slope = POSITIVE, Hope increases with level of fundamentalism.
# Quadratic slope = POSITIVE, Hope effect PEAK in middle
# --> difference between M-L > difference between F-M 

# Predict Optimism from Influen, Involve, Hope 
summary(lm(Optim ~ RInfluen + RInvolve + RHope, data = dat))
# Optim = -1.895 + 0.489(Influen) - 0.079(Involve) + 0.428(Hope) + error
#                     signif.         NOT signif.       signif.
# Influen: F(1,597) = 
# Involve: F(1,597) = 
# Hope: F(1,597) = 



# Test polynomial contrast of GROUP = significant reduction of error
modC <- lm(Optim ~ RInfluen + RInvolve + RHope, data = dat)
modA <- lm(Optim ~ RInfluen + RInvolve + RHope + Group, data = dat)
summary(modA)
# Optim = -1.185 + 0.38796(Influence) - 0.094(Involve) + 0.3795(Hope) + 0.4426(Linear) - 0.0486(Quadratic) + error
#                     signif**           NOT signif.      signif.         signif*           NOT signif.
anova(modC, modA)
# Res.Df    RSS    Df S um of Sq      F      Pr(>F)  
# 1 596    5519.8                                    
# 2 594    5472.8  2    46.953     2.5481    0.07909.
# PRE: (5519.8-5472.8)/5519.8 = 0.0085 (very small reduction...)
# F(2,594) = 2.548, p = 0.079, FAIL TO REJECT, adding GROUP contrasts NOT significant effect
# Linear-GROUP mildly significant. 
#
#

# Homogeneity of Influence, Involve, HOpe over GROUPS
modA2 <-lm(Optim ~ (RInfluen + RInvolve + RHope)*Group, data = dat)
summary(modA2)
#
anova(modA, modA2)
# Res.Df    RSS     Df    Sum of Sq      F    Pr(>F)
# 1    594 5472.8                                   
# 2    588 5447.6   6      25.193      0.4532 0.8428
# F(6,558) = 0.4532, p = 0.8424, FAIL TO REJECT NULL, Homogeneity stands. 
# ALL individual interaction effects = NOT significant. 



