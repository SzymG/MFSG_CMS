<?php

use yii\db\Migration;


class m201123_210151_create extends Migration
{
    public function safeUp() {
        $this->execute('
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'NO_AUTO_VALUE_ON_ZERO\' */;


-- Zrzut struktury bazy danych mfsg_cms
CREATE DATABASE IF NOT EXISTS `mfsg_cms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mfsg_cms`;

-- Zrzut struktury tabela mfsg_cms.config
CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(55) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli mfsg_cms.config: ~12 rows (około)
INSERT INTO `config` (`config_id`, `config_name`, `config_value`) VALUES
	(1, \'title\', \'CMS\'),
	(2, \'description\', \'Content management system\'),
	(3, \'keywords\', \'cms\'),
	(4, \'rootemail\', \'example@gmail.com\'),
	(5, \'foot\', \'Stopka\');

-- Zrzut struktury tabela mfsg_cms.event
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(150) NOT NULL,
  `event_text` text NOT NULL,
  `event_date_start` datetime NOT NULL,
  `event_date_end` datetime DEFAULT NULL,
  `event_photo_url` varchar(65) DEFAULT NULL,
  `is_only_for_authorized` tinyint(1) NOT NULL,
  `event_url` varchar(65) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `event_date` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- Zrzut struktury tabela mfsg_cms.log
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_user_id` int(11) DEFAULT NULL,
  `log_what` varchar(50) NOT NULL,
  `log_time` datetime NOT NULL,
  `log_ip` varchar(15) NOT NULL,
  `log_message` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_log_user` (`log_user_id`),
  CONSTRAINT `fk_log_user` FOREIGN KEY (`log_user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

-- Zrzut struktury tabela mfsg_cms.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_title` varchar(255) NOT NULL,
  `menu_poz` int(11) NOT NULL,
  `menu_what` varchar(25) NOT NULL,
  `menu_content_id` int(11) NOT NULL,
  `menu_extra` varchar(255) NOT NULL,
  `is_only_for_authorized` tinyint(1) NOT NULL DEFAULT 0,
  `menu_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- Zrzut struktury tabela mfsg_cms.news
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(150) NOT NULL,
  `news_text` text NOT NULL,
  `news_date` datetime NOT NULL,
  `news_url` varchar(150) NOT NULL,
  `is_only_for_authorized` tinyint(1) NOT NULL,
  `news_photo_url` varchar(150) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;


-- Zrzut struktury tabela mfsg_cms.page
CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(150) NOT NULL,
  `page_text` text NOT NULL,
  `is_only_for_authorized` tinyint(1) NOT NULL,
  `page_url` varchar(150) NOT NULL,
  `page_main` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli mfsg_cms.page: ~0 rows (około)
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` (`page_id`, `page_title`, `page_text`, `is_only_for_authorized`, `page_url`, `page_main`, `is_active`) VALUES
	(1, \'Strona główna\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. \', 0, \'home\', 1, 0);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;

-- Zrzut struktury tabela mfsg_cms.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(90) NOT NULL,
  `user_namesurname` varchar(85) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_about` text NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_key` varchar(20) NOT NULL,
  `user_register` datetime NOT NULL,
  `user_registered_ip` varchar(15) NOT NULL,
  `user_active` tinyint(1) NOT NULL,
  `user_activated` datetime NOT NULL,
  `user_activated_ip` varchar(15) NOT NULL,
  `user_root` tinyint(1) NOT NULL,
  `user_password_hash1` varchar(20) NOT NULL,
  `user_password_hash2` varchar(20) NOT NULL,
  `user_password_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli mfsg_cms.user: ~2 rows (około)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `user_email`, `user_namesurname`, `user_phone`, `user_about`, `user_password`, `user_key`, `user_register`, `user_registered_ip`, `user_active`, `user_activated`, `user_activated_ip`, `user_root`, `user_password_hash1`, `user_password_hash2`, `user_password_time`) VALUES
	(1, \'mfsg.cms@gmail.com\', \'MFSG Admin\', \'\', \'\', \'$2y$10$3rF37/HikC1xm41afRPP2OWq4rFFgve1UzDbJ26I9FNjDrWuNgsG2\', \'dvm6yw4yukwrlgmsx9jq\', \'2020-11-23 17:18:26\', \'127.0.0.1\', 1, \'2018-02-03 09:22:44\', \'127.0.0.1\', 1, \'\', \'\', \'0000-00-00 00:00:00\');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, \'\') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

        ');
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
