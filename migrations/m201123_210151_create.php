<?php

use yii\db\Migration;


class m201123_210151_create extends Migration
{
    public function safeUp() {
        $this->execute('CREATE TABLE `event` (
         `event_id` int(11) NOT NULL,
         `event_title` varchar(150) NOT NULL,
         `event_text` text NOT NULL,
         `event_author` varchar(55) NOT NULL,
         `event_date_start` datetime NOT NULL,
         `event_date_end` datetime NOT NULL,
         `event_photo_url` varchar(65),
         `is_only_for_authorized` TINYINT(1) NOT NULL,
         `event_url` varchar(65) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('ALTER TABLE `event`
            ADD PRIMARY KEY (`event_id`);
            ALTER TABLE `event`
            MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;');

        $this->execute('CREATE TABLE `news` (
             `news_id` int(11) NOT NULL,
             `news_title` varchar(150) NOT NULL,
             `news_text` text NOT NULL,
             `news_date` datetime NOT NULL,
             `news_url` varchar(150) NOT NULL,
             `is_only_for_authorized` TINYINT(1) NOT NULL,
             `news_photo_url` varchar(150) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('ALTER TABLE `news`
            ADD PRIMARY KEY (`news_id`);
            ALTER TABLE `news`
            MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
            ');

        $this->execute('CREATE TABLE `config` (
             `config_id` int(11) NOT NULL,
             `config_name` varchar(15) NOT NULL,
             `config_value` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('INSERT INTO `config` (`config_id`, `config_name`, `config_value`) VALUES
            (1, \'title\', \'MFSG_CMS\'),
            (2, \'description\', \'Content management system\'),
            (3, \'keywords\', \'cms\'),
            (4, \'rootemail\', \'mfsg.cms@gmail.com\'),
            (5, \'foot\', \'Copyright &copy; 2020 by MFSG_CMS\');
            ');

        $this->execute('ALTER TABLE `config`
            ADD PRIMARY KEY (`config_id`);
            ALTER TABLE `config`
            MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;');

        $this->execute('CREATE TABLE `error404` (
             `error_id` int(11) NOT NULL,
             `error_page_from` text NOT NULL,
             `error_page` text CHARACTER SET latin2 NOT NULL,
             `error_date` datetime NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('ALTER TABLE `error404`
             ADD PRIMARY KEY (`error_id`);
            ALTER TABLE `error404`
             MODIFY `error_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;');

        $this->execute('CREATE TABLE `log` (
             `log_id` int(11) NOT NULL,
             `log_user_id` int(11) NOT NULL,
             `log_what` varchar(50) NOT NULL,
             `log_time` datetime NOT NULL,
             `log_ip` varchar(15) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('ALTER TABLE `log`
             ADD PRIMARY KEY (`log_id`);
            ALTER TABLE `log`
             MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;');

        $this->execute('CREATE TABLE `menu` (
             `menu_id` int(11) NOT NULL,
             `menu_title` varchar(255) NOT NULL,
             `menu_poz` int(11) NOT NULL,
             `menu_sub` int(11) NOT NULL,
             `menu_login` char(1) NOT NULL,
             `menu_what` varchar(25) NOT NULL,
             `menu_content_id` int(11) NOT NULL,
             `menu_extra` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('INSERT INTO `menu` (`menu_id`, `menu_title`, `menu_poz`, `menu_sub`, `menu_login`, `menu_what`,
`menu_content_id`, `menu_extra`) VALUES
(40, \'Home page\', 1, 0, \'n\', \'main\', 0, \'\'),
(62, \'Text pages\', 2, 0, \'n\', \'page\', 0, \'\'),
(63, \'Download\', 5, 0, \'n\', \'download\', 0, \'\'),
(64, \'Blog\', 3, 0, \'n\', \'blog\', 0, \'\'),
(65, \'Articles\', 4, 0, \'n\', \'article\', 0, \'\'),
(66, \'Contact\', 6, 0, \'n\', \'contact\', 0, \'\'),
(72, \'Curious\', 7, 0, \'n\', \'main\', 0, \'\'),
(74, \'Blog entry\', 1, 72, \'n\', \'blogone\', 7, \'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elitmaecenas-id-nulla-nec-dui-efficitur-pretium\'),
(75, \'Example page\', 2, 72, \'n\', \'pageone\', 2, \'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit\'),
(76, \'Example article\', 3, 72, \'n\', \'articleone\', 1, \'lorem-ipsum-dolor-sit-amet-consectetur-adipiscingelit\');');

        $this->execute('ALTER TABLE `menu`
     ADD PRIMARY KEY (`menu_id`);
    ALTER TABLE `menu`
     MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
    ');
        $this->execute('CREATE TABLE `page` (
     `page_id` int(11) NOT NULL,
     `page_title` varchar(150) NOT NULL,
     `page_text` text NOT NULL,
     `is_only_for_authorized` TINYINT(1) NOT NULL,
     `page_url` varchar(150) NOT NULL,
     `page_main` char(1) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('INSERT INTO `page` (`page_id`, `page_title`, `page_text`, `is_only_for_authorized`, `page_url`, `page_main`) VALUES
            (1, \'Home Page Title\', \'Home Page Text\', 0, \'home\', \'y\');');

        $this->execute('ALTER TABLE `page`
             ADD PRIMARY KEY (`page_id`);
            ALTER TABLE `page`
             MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;');

        $this->execute('CREATE TABLE `password` (
             `password_id` int(11) NOT NULL,
             `password_user_id` int(11) NOT NULL,
             `password_hash1` varchar(20) NOT NULL,
             `password_hash2` varchar(20) NOT NULL,
             `password_time` datetime NOT NULL,
             `password_time_used` datetime NOT NULL,
             `password_ip` varchar(15) NOT NULL,
             `password_used` char(1) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('ALTER TABLE `password`
             ADD PRIMARY KEY (`password_id`);
            ALTER TABLE `password`
             MODIFY `password_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;');

        $this->execute('CREATE TABLE `user` (
             `user_id` int(11) NOT NULL,
             `user_email` varchar(90) NOT NULL,
             `user_namesurname` varchar(85) NOT NULL,
             `user_phone` varchar(20) NOT NULL,
             `user_about` text NOT NULL,
             `user_password` varchar(255) NOT NULL,
             `user_key` varchar(20) NOT NULL,
             `user_register` datetime NOT NULL,
             `user_registered_ip` varchar(15) NOT NULL,
             `user_active` char(1) NOT NULL,
             `user_activated` datetime NOT NULL,
             `user_activated_ip` varchar(15) NOT NULL,
             `user_root` char(1) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

        $this->execute('INSERT INTO `user` (`user_id`, `user_email`, `user_namesurname`, `user_phone`,
`user_about`, `user_password`, `user_key`, `user_register`, `user_registered_ip`, `user_active`,
`user_activated`, `user_activated_ip`, `user_root`) VALUES
(1, \'mfsg.cms@gmail.com\', \'MFSG Admin\', \'\', \'\',
\'$2y$10$o0.1ukLMSTYAIuQhrp69SepO6RY/Whu/XSucQJwzEs6eg03oHMa3a\', \'dvm6yw4yukwrlgmsx9jq\', \'2020-11-23
17:18:26\', \'127.0.0.1\', \'y\', \'2018-02-03 09:22:44\', \'127.0.0.1\', \'y\');');

        $this->execute('ALTER TABLE `user` ADD PRIMARY KEY (`user_id`);
            ALTER TABLE `user` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;');
    }

    public function safeDown() {
        $this->dropTable('event');
        $this->dropTable('news');
        $this->dropTable('config');
        $this->dropTable('error404');
        $this->dropTable('log');
        $this->dropTable('menu');
        $this->dropTable('page');
        $this->dropTable('password');
        $this->dropTable('user');
    }
}
