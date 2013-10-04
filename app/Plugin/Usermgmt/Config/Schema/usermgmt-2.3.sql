CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tmp_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_id` bigint(100) DEFAULT NULL,
  `fb_access_token` text,
  `twt_id` bigint(100) DEFAULT NULL,
  `twt_access_token` text,
  `twt_access_secret` text,
  `ldn_id` varchar(100) DEFAULT NULL,
  `user_group_id` varchar(256) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `active` varchar(3) DEFAULT '0',
  `email_verified` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `by_admin` int(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `users` (`id`, `fb_id`, `fb_access_token`, `twt_id`, `twt_access_token`, `twt_access_secret`, `ldn_id`, `user_group_id`, `username`, `password`, `salt`, `email`, `first_name`, `last_name`, `active`, `email_verified`, `last_login`, `by_admin`, `ip_address`, `created`, `modified`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'admin', 'f0e69aeb148b5216102d647111eaab45295e40170d17ec61f0484ad173e1a311', 'RUVVXbyzhfUz6oEyIQOA7X+WO33Fuum76ghD/2aXgB8y/1l2xlkF2hk9PaOjwjiq', 'admin@admin.com', 'Admin', '', '1', 1, '2012-04-14 10:11:52', 0, '', now(), now());

CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(256) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `last_action` int(10) DEFAULT NULL,
  `last_url` text,
  `logout_time` int(10) DEFAULT NULL,
  `user_browser` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `logout` int(11) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `photo` text,
  `bday` date DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `cellphone` varchar(15) DEFAULT NULL,
  `web_page` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `photo`, `bday`, `location`, `marital_status`, `cellphone`, `web_page`, `created`, `modified`) VALUES
(1, 1, 'male', '', '1986-01-30', '', 'single', '', '', now(), now());

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `alias_name` varchar(100) DEFAULT NULL,
  `description` TEXT NULL,
  `allowRegistration` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `user_groups` (`id`, `parent_id`, `name`, `alias_name`, `description`, `allowRegistration`, `created`, `modified`) VALUES
(1, 0, 'Admin', 'Admin', NULL, 0, now(), now()),
(2, 0, 'User', 'User', NULL, 1, now(), now()),
(3, 0, 'Guest', 'Guest', NULL, 0, now(), now());

CREATE TABLE IF NOT EXISTS `user_group_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) unsigned NOT NULL,
  `controller` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=170 ;

INSERT INTO `user_group_permissions` (`id`, `user_group_id`, `controller`, `action`, `allowed`) VALUES
(1, 1, 'Pages', 'display', 1),
(2, 2, 'Pages', 'display', 1),
(3, 3, 'Pages', 'display', 1),
(4, 1, 'UserGroupPermissions', 'index', 1),
(5, 2, 'UserGroupPermissions', 'index', 0),
(6, 3, 'UserGroupPermissions', 'index', 0),
(7, 1, 'UserGroups', 'index', 1),
(8, 2, 'UserGroups', 'index', 0),
(9, 3, 'UserGroups', 'index', 0),
(10, 1, 'UserGroups', 'addGroup', 1),
(11, 2, 'UserGroups', 'addGroup', 0),
(12, 3, 'UserGroups', 'addGroup', 0),
(13, 1, 'UserGroups', 'editGroup', 1),
(14, 2, 'UserGroups', 'editGroup', 0),
(15, 3, 'UserGroups', 'editGroup', 0),
(16, 1, 'UserGroups', 'deleteGroup', 1),
(17, 2, 'UserGroups', 'deleteGroup', 0),
(18, 3, 'UserGroups', 'deleteGroup', 0),
(19, 1, 'UserSettings', 'index', 1),
(20, 2, 'UserSettings', 'index', 0),
(21, 3, 'UserSettings', 'index', 0),
(22, 1, 'UserSettings', 'editSetting', 1),
(23, 2, 'UserSettings', 'editSetting', 0),
(24, 3, 'UserSettings', 'editSetting', 0),
(25, 1, 'Users', 'index', 1),
(26, 2, 'Users', 'index', 0),
(27, 3, 'Users', 'index', 0),
(28, 1, 'Users', 'online', 1),
(29, 2, 'Users', 'online', 0),
(30, 3, 'Users', 'online', 0),
(31, 1, 'Users', 'viewUser', 1),
(32, 2, 'Users', 'viewUser', 0),
(33, 3, 'Users', 'viewUser', 0),
(34, 1, 'Users', 'myprofile', 0),
(35, 2, 'Users', 'myprofile', 1),
(36, 3, 'Users', 'myprofile', 0),
(37, 1, 'Users', 'editProfile', 1),
(38, 2, 'Users', 'editProfile', 1),
(39, 3, 'Users', 'editProfile', 0),
(40, 1, 'Users', 'login', 1),
(41, 2, 'Users', 'login', 1),
(42, 3, 'Users', 'login', 1),
(43, 1, 'Users', 'logout', 1),
(44, 2, 'Users', 'logout', 1),
(45, 3, 'Users', 'logout', 1),
(46, 1, 'Users', 'register', 1),
(47, 2, 'Users', 'register', 1),
(48, 3, 'Users', 'register', 1),
(49, 1, 'Users', 'changePassword', 1),
(50, 2, 'Users', 'changePassword', 1),
(51, 3, 'Users', 'changePassword', 0),
(52, 1, 'Users', 'changeUserPassword', 1),
(53, 2, 'Users', 'changeUserPassword', 0),
(54, 3, 'Users', 'changeUserPassword', 0),
(55, 1, 'Users', 'addUser', 1),
(56, 2, 'Users', 'addUser', 0),
(57, 3, 'Users', 'addUser', 0),
(58, 1, 'Users', 'editUser', 1),
(59, 2, 'Users', 'editUser', 0),
(60, 3, 'Users', 'editUser', 0),
(61, 1, 'Users', 'deleteUser', 1),
(62, 2, 'Users', 'deleteUser', 0),
(63, 3, 'Users', 'deleteUser', 0),
(64, 1, 'Users', 'deleteAccount', 0),
(65, 2, 'Users', 'deleteAccount', 1),
(66, 3, 'Users', 'deleteAccount', 0),
(67, 1, 'Users', 'logoutUser', 1),
(68, 2, 'Users', 'logoutUser', 0),
(69, 3, 'Users', 'logoutUser', 0),
(70, 1, 'Users', 'makeInactive', 1),
(71, 2, 'Users', 'makeInactive', 0),
(72, 3, 'Users', 'makeInactive', 0),
(73, 1, 'Users', 'dashboard', 1),
(74, 2, 'Users', 'dashboard', 1),
(75, 3, 'Users', 'dashboard', 1),
(76, 1, 'Users', 'makeActiveInactive', 1),
(77, 2, 'Users', 'makeActiveInactive', 0),
(78, 3, 'Users', 'makeActiveInactive', 0),
(79, 1, 'Users', 'verifyEmail', 1),
(80, 2, 'Users', 'verifyEmail', 0),
(81, 3, 'Users', 'verifyEmail', 0),
(82, 1, 'Users', 'accessDenied', 1),
(83, 2, 'Users', 'accessDenied', 1),
(84, 3, 'Users', 'accessDenied', 0),
(85, 1, 'Users', 'userVerification', 1),
(86, 2, 'Users', 'userVerification', 1),
(87, 3, 'Users', 'userVerification', 1),
(88, 1, 'Users', 'forgotPassword', 1),
(89, 2, 'Users', 'forgotPassword', 1),
(90, 3, 'Users', 'forgotPassword', 1),
(91, 1, 'Users', 'emailVerification', 1),
(92, 2, 'Users', 'emailVerification', 1),
(93, 3, 'Users', 'emailVerification', 1),
(94, 1, 'Users', 'activatePassword', 1),
(95, 2, 'Users', 'activatePassword', 1),
(96, 3, 'Users', 'activatePassword', 1),
(97, 1, 'UserGroupPermissions', 'update', 1),
(98, 2, 'UserGroupPermissions', 'update', 0),
(99, 3, 'UserGroupPermissions', 'update', 0),
(100, 1, 'Users', 'deleteCache', 1),
(101, 2, 'Users', 'deleteCache', 0),
(102, 3, 'Users', 'deleteCache', 0),
(103, 1, 'Autocomplete', 'fetch', 1),
(104, 2, 'Autocomplete', 'fetch', 1),
(105, 3, 'Autocomplete', 'fetch', 1),
(106, 1, 'Users', 'viewUserPermissions', 1),
(107, 2, 'Users', 'viewUserPermissions', 0),
(108, 3, 'Users', 'viewUserPermissions', 0),
(109, 1, 'Contents', 'index', 1),
(110, 2, 'Contents', 'index', 0),
(111, 3, 'Contents', 'index', 0),
(112, 1, 'Contents', 'addPage', 1),
(113, 2, 'Contents', 'addPage', 0),
(114, 3, 'Contents', 'addPage', 0),
(115, 1, 'Contents', 'editPage', 1),
(116, 2, 'Contents', 'editPage', 0),
(117, 3, 'Contents', 'editPage', 0),
(118, 1, 'Contents', 'viewPage', 1),
(119, 2, 'Contents', 'viewPage', 0),
(120, 3, 'Contents', 'viewPage', 0),
(121, 1, 'Contents', 'deletePage', 1),
(122, 2, 'Contents', 'deletePage', 0),
(123, 3, 'Contents', 'deletePage', 0),
(124, 1, 'Contents', 'content', 1),
(125, 2, 'Contents', 'content', 1),
(126, 3, 'Contents', 'content', 1),
(127, 1, 'UserContacts', 'index', 1),
(128, 2, 'UserContacts', 'index', 0),
(129, 3, 'UserContacts', 'index', 0),
(130, 1, 'UserContacts', 'contactUs', 1),
(131, 2, 'UserContacts', 'contactUs', 1),
(132, 3, 'UserContacts', 'contactUs', 1),
(133, 1, 'Users', 'ajaxLoginRedirect', 1),
(134, 2, 'Users', 'ajaxLoginRedirect', 1),
(135, 3, 'Users', 'ajaxLoginRedirect', 1),
(136, 1, 'Users', 'viewProfile', 1),
(137, 2, 'Users', 'viewProfile', 1),
(138, 3, 'Users', 'viewProfile', 1),
(139, 1, 'Users', 'sendMails', 1),
(140, 2, 'Users', 'sendMails', 0),
(141, 3, 'Users', 'sendMails', 0),
(142, 1, 'Users', 'searchEmails', 1),
(143, 2, 'Users', 'searchEmails', 0),
(144, 3, 'Users', 'searchEmails', 0),
(145, 1, 'UserEmails', 'index', 1),
(146, 1, 'UserEmails', 'send', 1),
(147, 1, 'UserEmails', 'sendToUser', 1),
(148, 1, 'UserEmails', 'sendReply', 1),
(149, 1, 'UserEmails', 'view', 1),
(150, 1, 'UserGroupPermissions', 'subPermissions', 1),
(151, 1, 'UserGroupPermissions', 'getPermissions', 1),
(152, 1, 'UserGroupPermissions', 'permissionGroupMatrix', 1),
(153, 1, 'UserGroupPermissions', 'permissionSubGroupMatrix', 1),
(154, 1, 'UserGroupPermissions', 'changePermission', 1),
(155, 1, 'Users', 'indexSearch', 1),
(156, 1, 'UserEmailSignatures', 'index', 1),
(157, 1, 'UserEmailSignatures', 'add', 1),
(158, 1, 'UserEmailSignatures', 'edit', 1),
(159, 1, 'UserEmailSignatures', 'delete', 1),
(160, 1, 'UserEmailTemplates', 'index', 1),
(161, 1, 'UserEmailTemplates', 'add', 1),
(162, 1, 'UserEmailTemplates', 'edit', 1),
(163, 1, 'UserEmailTemplates', 'delete', 1),
(164, 1, 'UserSettings', 'cakelog', 1),
(165, 1, 'UserSettings', 'cakelogbackup', 1),
(166, 1, 'UserSettings', 'cakelogdelete', 1),
(167, 1, 'UserSettings', 'cakelogempty', 1),
(168, 1, 'Users', 'addMultipleUsers', 1),
(169, 1, 'Users', 'uploadCsv', 1);

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `name_public` text,
  `value` varchar(256) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `category` varchar(20) DEFAULT 'OTHER',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

INSERT INTO `user_settings` (`id`, `name`, `name_public`, `value`, `type`, `category`) VALUES
(1, 'defaultTimeZone', 'Enter default time zone identifier', 'America/New_York', 'input', 'OTHER'),
(2, 'siteName', 'Enter Your Site Name', 'User Management Plugin', 'input', 'OTHER'),
(3, 'siteRegistration', 'New Registration is allowed or not', '1', 'checkbox', 'USER'),
(4, 'allowDeleteAccount', 'Allow users to delete account', '0', 'checkbox', 'USER'),
(5, 'sendRegistrationMail', 'Send Registration Mail After User Registered', '1', 'checkbox', 'EMAIL'),
(6, 'sendPasswordChangeMail', 'Send Password Change Mail After User changed password', '1', 'checkbox', 'EMAIL'),
(7, 'emailVerification', 'Want to verify user''s email address?', '1', 'checkbox', 'EMAIL'),
(8, 'emailFromAddress', 'Enter email by which emails will be send.', 'example@example.com', 'input', 'EMAIL'),
(9, 'emailFromName', 'Enter Email From Name', 'User Management Plugin', 'input', 'EMAIL'),
(10, 'allowChangeUsername', 'Do you want to allow users to change their username?', '0', 'checkbox', 'USER'),
(11, 'bannedUsernames', 'Set banned usernames comma separated(no space, no quotes)', 'Administrator, SuperAdmin', 'input', 'USER'),
(12, 'useRecaptcha', 'Do you want to add captcha support on registration form, contact us form, login form in case bad logins, forgot password page, email verification page? Please note we have separate settings for all pages to Add or Remove captcha.', '0', 'checkbox', 'RECAPTCHA'),
(13, 'privateKeyFromRecaptcha', 'Enter private key for Recaptcha from google', '', 'input', 'RECAPTCHA'),
(14, 'publicKeyFromRecaptcha', 'Enter public key for recaptcha from google', '', 'input', 'RECAPTCHA'),
(15, 'loginRedirectUrl', 'Enter URL where user will be redirected after login ', '/dashboard', 'input', 'OTHER'),
(16, 'logoutRedirectUrl', 'Enter URL where user will be redirected after logout', '/login', 'input', 'OTHER'),
(17, 'permissions', 'Do you Want to enable permissions for users?', '1', 'checkbox', 'PERMISSION'),
(18, 'adminPermissions', 'Do you want to check permissions for Admin?', '0', 'checkbox', 'PERMISSION'),
(19, 'defaultGroupId', 'Enter default group id for user registration', '2', 'input', 'GROUP'),
(20, 'adminGroupId', 'Enter Admin Group Id', '1', 'input', 'GROUP'),
(21, 'guestGroupId', 'Enter Guest Group Id', '3', 'input', 'GROUP'),
(22, 'useFacebookLogin', 'Want to use Facebook Connect on your site?', '0', 'checkbox', 'FACEBOOK'),
(23, 'facebookAppId', 'Facebook Application Id', '', 'input', 'FACEBOOK'),
(24, 'facebookSecret', 'Facebook Application Secret Code', '', 'input', 'FACEBOOK'),
(25, 'facebookScope', 'Facebook Permissions', 'user_status, publish_stream, email', 'input', 'FACEBOOK'),
(26, 'useTwitterLogin', 'Want to use Twitter Connect on your site?', '0', 'checkbox', 'TWITTER'),
(27, 'twitterConsumerKey', 'Twitter Consumer Key', '', 'input', 'TWITTER'),
(28, 'twitterConsumerSecret', 'Twitter Consumer Secret', '', 'input', 'TWITTER'),
(29, 'useGmailLogin', 'Want to use Gmail Connect on your site?', '1', 'checkbox', 'GOOGLE'),
(30, 'useYahooLogin', 'Want to use Yahoo Connect on your site?', '1', 'checkbox', 'YAHOO'),
(31, 'useLinkedinLogin', 'Want to use Linkedin Connect on your site?', '0', 'checkbox', 'LINKEDIN'),
(32, 'linkedinApiKey', 'Linkedin Api Key', '', 'input', 'LINKEDIN'),
(33, 'linkedinSecretKey', 'Linkedin Secret Key', '', 'input', 'LINKEDIN'),
(34, 'useFoursquareLogin', 'Want to use Foursquare Connect on your site?', '0', 'checkbox', 'FOURSQUARE'),
(35, 'foursquareClientId', 'Foursquare Client Id', '', 'input', 'FOURSQUARE'),
(36, 'foursquareClientSecret', 'Foursquare Client Secret', '', 'input', 'FOURSQUARE'),
(37, 'viewOnlineUserTime', 'You can view online users and guest from last few minutes, set time in minutes ', '30', 'input', 'USER'),
(38, 'useHttps', 'Do you want to HTTPS for whole site?', '0', 'checkbox', 'OTHER'),
(39, 'httpsUrls', 'You can set selected urls for HTTPS (e.g. users/login, users/register)', NULL, 'input', 'OTHER'),
(40, 'imgDir', 'Enter Image directory name where users profile photos will be uploaded. This directory should be in webroot/img directory', 'umphotos', 'input', 'OTHER'),
(41, 'QRDN', 'Increase this number by 1 every time if you made any changes in CSS or JS file', '12345678', 'input', 'OTHER'),
(42, 'cookieName', 'Please enter cookie name for your site which is used to login user automatically for remember me functionality', 'UMPremiumCookie', 'input', 'OTHER'),
(43, 'adminEmailAddress', 'Admin Email address for emails', '', 'input', 'EMAIL'),
(44, 'useRecaptchaOnLogin', 'Do you want to add captcha support on login form in case bad logins? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(45, 'badLoginAllowCount', 'Set number of allowed bad logins. for e.g. 5 or 10. For this feature you must have Captcha setting ON with valid private and public keys.', '5', 'input', 'RECAPTCHA'),
(46, 'useRecaptchaOnRegistration', 'Do you want to add captcha support on registration form? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(47, 'useRecaptchaOnForgotPassword', 'Do you want to add captcha support on forgot password page? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(48, 'useRecaptchaOnEmailVerification', 'Do you want to add captcha support on email verification page? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(49, 'useRememberMe', 'Set true/false if you want to add/remove remember me feature on login page', '1', 'checkbox', 'USER'),
(50, 'allowUserMultipleLogin', 'Do you want to allow multiple logins with same user account for users(not admin)?', '1', 'checkbox', 'USER'),
(51, 'allowAdminMultipleLogin', 'Do you want to allow multiple logins with same user account for admin(not users)?', '1', 'checkbox', 'USER'),
(52, 'loginIdleTime', 'Set max idle time in minutes for user. This idle time will be used when multiple logins are not allowed for same user account. If max idle time reached since user last activity on site then anyone can login with same account in other browser and idle user will be logged out.', '10', 'input', 'USER');


CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` text,
  `url_name` text,
  `page_content` text,
  `page_title` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `requirement` text,
  `reply_message` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `user_group_id` varchar(256) DEFAULT NULL,
  `cc_to` text,
  `from_name` varchar(200) DEFAULT NULL,
  `from_email` varchar(200) DEFAULT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `sent_by` int(10) DEFAULT NULL,
  `is_email_sent` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_email_recipients` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_email_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `email_address` varchar(100) NOT NULL,
  `is_email_sent` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_email_templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(100) NOT NULL,
  `header` text,
  `footer` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_email_signatures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `signature_name` varchar(100) NOT NULL,
  `signature` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;