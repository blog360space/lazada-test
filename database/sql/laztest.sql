/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : laztest

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-08-25 10:12:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for post_tags
-- ----------------------------
DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE `post_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of post_tags
-- ----------------------------
INSERT INTO `post_tags` VALUES ('1', '1', '1', '2016-08-25 02:55:45', '2016-08-25 02:55:45');
INSERT INTO `post_tags` VALUES ('2', '2', '1', '2016-08-25 02:55:45', '2016-08-25 02:55:45');
INSERT INTO `post_tags` VALUES ('3', '3', '2', '2016-08-25 03:02:05', '2016-08-25 03:02:05');
INSERT INTO `post_tags` VALUES ('4', '4', '2', '2016-08-25 03:02:05', '2016-08-25 03:02:05');
INSERT INTO `post_tags` VALUES ('5', '1', '3', '2016-08-25 03:03:05', '2016-08-25 03:03:05');
INSERT INTO `post_tags` VALUES ('6', '5', '3', '2016-08-25 03:03:05', '2016-08-25 03:03:05');
INSERT INTO `post_tags` VALUES ('7', '6', '3', '2016-08-25 03:03:05', '2016-08-25 03:03:05');
INSERT INTO `post_tags` VALUES ('8', '7', '4', '2016-08-25 03:04:37', '2016-08-25 03:04:37');
INSERT INTO `post_tags` VALUES ('9', '8', '4', '2016-08-25 03:04:37', '2016-08-25 03:04:37');
INSERT INTO `post_tags` VALUES ('17', '10', '5', '2016-08-25 03:07:23', '2016-08-25 03:07:23');
INSERT INTO `post_tags` VALUES ('18', '8', '5', '2016-08-25 03:07:23', '2016-08-25 03:07:23');
INSERT INTO `post_tags` VALUES ('19', '11', '5', '2016-08-25 03:07:24', '2016-08-25 03:07:24');
INSERT INTO `post_tags` VALUES ('20', '1', '6', '2016-08-25 03:08:30', '2016-08-25 03:08:30');
INSERT INTO `post_tags` VALUES ('21', '12', '6', '2016-08-25 03:08:30', '2016-08-25 03:08:30');
INSERT INTO `post_tags` VALUES ('22', '5', '6', '2016-08-25 03:08:30', '2016-08-25 03:08:30');
INSERT INTO `post_tags` VALUES ('23', '1', '7', '2016-08-25 03:09:41', '2016-08-25 03:09:41');
INSERT INTO `post_tags` VALUES ('24', '13', '7', '2016-08-25 03:09:41', '2016-08-25 03:09:41');
INSERT INTO `post_tags` VALUES ('25', '14', '7', '2016-08-25 03:09:41', '2016-08-25 03:09:41');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', 'Object-Oriented PHP for Beginners', 'For many PHP programmers, object-oriented programming is a frightening concept, full of complicated syntax and other roadblocks. As detailed in my book, Pro PHP and jQuery, you\'ll learn the concepts behind object-oriented programming (OOP), a style of coding in which related actions are grouped into classes to aid in creating more-compact, effective code.  To see what you can do with object-oriented PHP, take a look at the huge range of PHP scripts on CodeCanyon, such as this SQLite Object-Oriented Framework.  Or, if you\'re struggling with the do-it-yourself approach, you could hire a professional on Envato Studio either to fix errors for you or to create full PHP applications and modules.', '2016-08-25 02:55:45', '2016-08-25 02:55:45');
INSERT INTO `posts` VALUES ('2', '3 Firefox Add-ons Every Ubuntu User Needs', 'Firefox is the default browser in Ubuntu — but it doesn’t integrate with the Unity desktop as well as it could.  That’s where the following Ubuntu Firefox add-ons come in. These little extras, trivial though they seem, help to bridge the (admittedly few) gaps and missing functionality between browser and OS.  None of these are new, but they’re all undeniably helpful and help you get the best Firefox experience you can on the Unity desktop.  1. Firefox Notify firefox linux download notifications  This first one is simple enough: get a desktop notification when files you download in the browser complete.  Yeah, it’s bizarre that Firefox can’t do this by default, but it can’t. Instead you need to add this add-on.  Once enabled (and you’ve restarted) you’ll get download notifications on your Linux desktop through its native desktop notification system. On Ubuntu that’s via Notify OSD.  If you’re using GNOME Shell you’ll get nifty actionable screen toasts that let you open the downloaded file right away — handy!  ‘GNotifier’ on Mozilla Add-ons  2. Download Count & Progress Bars firefox unity integration  We featured the revived UnityFox extension a couple of weeks back. It’s simple enough: when there are downloads in progress it displays a progress bar and download count.  If you like to keep an eye on your active downloads while using other applications, having a Skype call, or reading websites like this one, UnityFox Revived is a must-have.  ‘UnityFox Revived’ on Mozilla Add-Ons  3. Matching GTK Theme firefox arc dark theme  A wholly optional extra this one. Not to mention one that I can’t guarantee is available. It all depends on what GTK theme you’re using.  See, Firefox does a good job of picking up and blending into the Ubuntu desktop, doubly so since GTK3 support was rolled out.  But if you use a third-party GTK theme on Ubuntu, like Arc, Moka, or Iris Dark, you may find there’s a custom Firefox theme available — but finding it isn’t the easy bit.  Mozilla’s add-ons repository has a Firefox Arc theme available, plus versions for Arc Dark and Arc Darker. GitHub has a (now deprecated) Numix theme, while Moka fans will find various userstyles available on, well, userstyles.', '2016-08-25 03:02:05', '2016-08-25 03:02:05');
INSERT INTO `posts` VALUES ('3', 'Getting Started with Zend Framework 2', 'This tutorial is intended to give an introduction to using Zend Framework 2 by creating a simple database driven application using the Model-View-Controller paradigm. By the end you will have a working ZF2 application and you can then poke around the code to find out more about how it all works and fits together.  Some assumptions¶ This tutorial assumes that you are running at least PHP 5.3.23 with the Apache web server and MySQL, accessible via the PDO extension. Your Apache installation must have the mod_rewrite extension installed and configured.  You must also ensure that Apache is configured to support .htaccess files. This is usually done by changing the setting:', '2016-08-25 03:03:05', '2016-08-25 03:03:05');
INSERT INTO `posts` VALUES ('4', 'Getting Started with jQuery', 'What You Should Already Know Before you start studying jQuery, you should have a basic knowledge of:  HTML CSS JavaScript If you want to study these subjects first, find the tutorials on our Home page.  What is jQuery? jQuery is a lightweight, \"write less, do more\", JavaScript library.  The purpose of jQuery is to make it much easier to use JavaScript on your website.  jQuery takes a lot of common tasks that require many lines of JavaScript code to accomplish, and wraps them into methods that you can call with a single line of code.  jQuery also simplifies a lot of the complicated things from JavaScript, like AJAX calls and DOM manipulation.  The jQuery library contains the following features:  HTML/DOM manipulation CSS manipulation HTML event methods Effects and animations AJAX Utilities Tip: In addition, jQuery has plugins for almost any task out there.  Why jQuery? There are lots of other JavaScript frameworks out there, but jQuery seems to be the most popular, and also the most extendable.  Many of the biggest companies on the Web use jQuery, such as:  Google Microsoft IBM Netflix', '2016-08-25 03:04:37', '2016-08-25 03:04:37');
INSERT INTO `posts` VALUES ('5', 'AngularJS Tutorial', 'This Tutorial This tutorial is specially designed to help you learn AngularJS as quickly and efficiently as possible.  First, you will learn the basics of AngularJS: directives, expressions, filters, modules, and controllers.  Then you will learn everything else you need to know about AngularJS:  Events, DOM, Forms, Input, Validation, Http, and more.  Try it Yourself Examples in Every Chapter In every chapter, you can edit the examples online, and click on a button to view the result.', '2016-08-25 03:05:48', '2016-08-25 03:07:23');
INSERT INTO `posts` VALUES ('6', 'What to Expect When You\'re Expecting: PHP 7, Part 1', 'As many of you are probably aware, the RFC I mentioned in my PHP 5.0.0 timeline passed with PHP 7 being the agreed upon name for the next major version of PHP. Regardless of your feelings on this topic, PHP 7 is a thing, and it’s coming this year! With the RFC for the PHP 7.0 Timeline passing almost unanimously (32 to 2), we have now entered into feature freeze, and we’ll see the first release candidate (RC) appearing in mid June. But what does this mean for you? We have seen a huge reluctance of web hosts to move towards newer versions of 5.x. Won’t a major version bring huge backwards compatibility breaks and make that move even slower? The answer to that is: it depends. So keep reading. A number of language edge cases have been cleaned up. Additionally, both performance and inconsistency fixes have been major focuses for this release. Let’s get into the details.', '2016-08-25 03:08:30', '2016-08-25 03:08:30');
INSERT INTO `posts` VALUES ('7', 'PHPUnit – The PHP Testing Framework', 'PHPUnit 5.5 is the current stable release series. It became stable on August 5, 2016. Its support ends on October 7, 2016 when PHPUnit 5.6 is released.  You can find out what\'s new in PHPUnit 5.5 in the release announcement.  PHPUnit 5.5 is supported on PHP 5.6 and PHP 7.   Download PHPUnit 5.5 (current stable release). PHPUnit 4.8 is the current old stable release series. It became stable on August 7, 2015. Its support ends on February 3, 2017 when PHPUnit 6 is released.  You can find out what\'s new in PHPUnit 4.8 in the release announcement.  PHPUnit 4.8 is supported on PHP 5.3, PHP 5.4, PHP 5.5, and PHP 5.6.   Download PHPUnit 4.8 (old stable release)', '2016-08-25 03:09:41', '2016-08-25 03:09:41');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', 'php', '2016-08-25 02:55:45', '2016-08-25 02:55:45');
INSERT INTO `tags` VALUES ('2', 'opp', '2016-08-25 02:55:45', '2016-08-25 02:55:45');
INSERT INTO `tags` VALUES ('3', 'ubuntu', '2016-08-25 03:02:05', '2016-08-25 03:02:05');
INSERT INTO `tags` VALUES ('4', 'firefox', '2016-08-25 03:02:05', '2016-08-25 03:02:05');
INSERT INTO `tags` VALUES ('5', 'zend', '2016-08-25 03:03:05', '2016-08-25 03:03:05');
INSERT INTO `tags` VALUES ('6', 'zendframework', '2016-08-25 03:03:05', '2016-08-25 03:03:05');
INSERT INTO `tags` VALUES ('7', 'jQuery', '2016-08-25 03:04:37', '2016-08-25 03:04:37');
INSERT INTO `tags` VALUES ('8', 'javascript', '2016-08-25 03:04:37', '2016-08-25 03:04:37');
INSERT INTO `tags` VALUES ('9', 'php7', '2016-08-25 03:05:48', '2016-08-25 03:05:48');
INSERT INTO `tags` VALUES ('10', 'angularjs', '2016-08-25 03:07:23', '2016-08-25 03:07:23');
INSERT INTO `tags` VALUES ('11', 'google', '2016-08-25 03:07:24', '2016-08-25 03:07:24');
INSERT INTO `tags` VALUES ('12', 'php7.0', '2016-08-25 03:08:30', '2016-08-25 03:08:30');
INSERT INTO `tags` VALUES ('13', 'phpunit', '2016-08-25 03:09:41', '2016-08-25 03:09:41');
INSERT INTO `tags` VALUES ('14', 'unitest', '2016-08-25 03:09:41', '2016-08-25 03:09:41');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
