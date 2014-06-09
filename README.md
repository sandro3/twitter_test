Twitter Test
==============

Program that accepts a twitter username as input, and returns the last 5 tweets, plus number of Tweets, Following, and Followers for that twitter username.

How to use
----------
```
1. cp conf/live/account.php conf/dev

2. Update conf/dev/account.php with your authorisation data.

3. cd scripts && php cli_test.php screen_name
```

Example
-------
```
$ php cli_test.php jeremyclarkson
Twitter Test

Name: Jeremy Clarkson
Followers: 3488391
Following: 134
Tweets: 3647

Mon Jun 09 18:23:12 +0000 2014
@Augusta__ Mine too. Eat as much as possible and do nothing.

Mon Jun 09 14:40:08 +0000 2014
@Lord_Sugar Or better still, one of mine.

Sun Jun 08 17:59:29 +0000 2014
@sniffpetrol You missed some sparkling interviews. Many adenoids.

Sun Jun 08 11:01:16 +0000 2014
Thankyou to everyone who has said kind things about my column in the Sunday Times this morning.

Sat Jun 07 18:21:53 +0000 2014
@RichardHammond Well you say that....

```
