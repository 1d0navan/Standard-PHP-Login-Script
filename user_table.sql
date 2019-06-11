--This Script creates the needed database for the register script.

CREATE TABLE `user` (
  `user_id` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(1) NOT NULL,
  `validation_key` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `register_ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `register_date` datetime NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--An Insert could look like this:
INSERT INTO `user` (`user_id`, `username`, `password_hash`, `email`, `rank`, `validation_key`, `register_ip`, `register_date`, `deleted`) VALUES
('qznDbQxb', 'admin', 'fXXXXXXXXXXxxxxxxa02200352313bc059445190', 'asd@rzdev.de', 1, 'Ur&i5Mys?84RPk*d', '::1', '2019-06-02 13:26:15', 0);
