library(foreign)
IQ <- read.spss("~/R materials/R for Stats/Dataset for R/IQscores.sav")
is(IQ)
IQ <- as.data.frame(IQ)
is(IQ)
summary(IQ)
# Total # of errors, Sum of Absolute Errors, SSE
sum((IQ$IQ - 100) != 0)
sum(abs(IQ$IQ - 100))
sum((IQ$IQ -100)^2)
# Histogram
hist(IQ$IQ)
hist(IQ$IQ, breaks = seq(min(IQ$IQ), max(IQ$IQ), length = 10+1))
# Sample Mean, Sample Median, Sample Mode, Sample Variance, Sample Standard Deviation
mean(IQ$IQ)
median(IQ$IQ)
var(IQ$IQ)
sd(IQ$IQ)

# Sum of Absolute Errors, usage Sample Median as predictor
sum(abs(IQ$IQ - median(IQ$IQ)))
# Smaller than Model C (1342) > 1260, usage of sample median = minimize sum of absolute errors in the sample

# SSE, usage Sample Mean as predictor
sum((IQ$IQ- 105.4)^2)
# Smaller than Model C (25988) > 23072, usage of sample mean = minimize SSE in the sample