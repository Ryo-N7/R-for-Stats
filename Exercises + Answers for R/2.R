library(foreign)
dat <- read.spss("~/R materials/R for Stats/Dataset for R/2016_Questionnaire_1_cleaned.sav")
dat <- as.data.frame(dat)
dat
# Select -Females-
fdat <- subset(dat,Gender == "Female")
# Histogram of subset Females - Height
hist(fdat$Height)

# SSE(C) ... Pop. Avg. height = 164.1
SSEC <- sum((fdat$Height - 164.1)^2)
SSEC
# SSE(A) ... Samp. Avg. height = 166.5222
SSEA <- sum((fdat$Height - mean(fdat$Height))^2)
SSEA

# F-statistic
sampleF <- (((SSEC-SSEA)/(1-0))/(SSEA/(nrow(fdat)-1)))
sampleF
# F(1,89) = 9.741194

# P-value 
1 - pf(sampleF, 1, 89)
# P(F(1,89) >= 9.741) = 0.002
# Critical value = 3.960, REJECT NULL as F = 9.741 > crit = 3.96, 
# random sample of Female students NOT from same population as English Females in 2013 population.

# Select -Males-
mdat <- subset(dat, Gender == "Male  ")
hist(mdat$Height)

# SSE(C) ... Pop. Avg. Height = 175.6
SSECm <- sum((mdat$Height - 175.6)^2)
SSECm
# SSE(A) ... Samp.Avg. Height = 176.5
SSEAm <- sum((mdat$Height - mean(mdat$Height))^2)
SSEAm
# Also compute SSE(A) from the variance: 
(nrow(mdat)-1)*var(mdat$Height)

# F-Statistic 
sampleFm <- (((SSECm - SSEAm)/ (1 - 0))/ (SSEAm/(nrow(mdat)-1)))
sampleFm
# F(1,49) = 0.8552036

# P-value 
1-pf(sampleFm, 1, 49)
# P(F(1,49) >= 0.855) = 0.3596165
# Critical value = 4.085, FAIL REJECT NULL as F = 0.855 < crit = 4.085
# random sample of Male students IS from same population as English Males in 2013 population.

# T-test (Females)
t.test(fdat$Height, mu = 164.1)

#T-test (Males)
t.test(mdat$Height, mu = 175.6)

# Part 2. Lecturer Height
hist(dat$Lecturer_height)
# Delete outliers
cdat <- subset(dat, !is.na(Lecturer_height) & Lecturer_height > 100)
hist(cdat$Lecturer_height)

# Create F-test function...

simpleFtest <- function(Y,value)  {
+ # Y is the dependent variable
+ # 'value' is the predicted value under model C
+ SSC <- sum((Y-value)^2)
+ SSA <- sum((Y-mean(Y))^2)
+ # compute the PRE
+ PRE <- (SSC-SSA)/SSC
+ # number of observations
+ n <- length(Y)
+ PA <- 1
+ PC <- 0
+ sampleF <- ((SSC-SSA)/(PA-PC))/(SSA/(n-PA))
+ pvalue <- 1-pf(sampleF,df1=PA-PC,df2=n-PA)
+ # use the 'cat' function to write the computed values on the console
+ cat("Simple F test, HO: mu =",value,"\n")
+ cat("sample mean =",mean(Y),"\n")
+ cat("SSC =",SSC," SSA =",SSA,"\n")
+ cat(paste("F(",PA-PC,",",n-PA,") =",sep=""),sampleF,
+ "p-value =" ,pvalue,"\n")
+ cat("PRE =",PRE,"\n")
+ }

simpleFtest(cdat$Lecturer_height,value=196)

# T-test
t.test(cdat$Lecturer_height, mu = 196)










