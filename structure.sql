
DROP TABLE IF EXISTS `markets_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `markets_table` (
  `fixture_id` varchar(20) NOT NULL,
  `home_team` varchar(50) NOT NULL,
  `away_team` varchar(50) NOT NULL,
  `commence_time` varchar(12) NOT NULL,
  `gamestatus` varchar(3) NOT NULL,
  `result` varchar(8) DEFAULT NULL,
  `total_goals` varchar(10) DEFAULT NULL,
  `halftime` varchar(20) DEFAULT NULL,
  `gg` varchar(10) DEFAULT NULL,
  `league_id` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`fixture_id`),
  KEY `league_id` (`league_id`),
  CONSTRAINT `markets_table_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `league_table` (`league_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `odds_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `odds_table` (
  `fixture_id` varchar(20) NOT NULL,
  `home_win` decimal(10,2) DEFAULT '1.00',
  `draw` decimal(10,2) NOT NULL DEFAULT '1.00',
  `away_win` decimal(10,2) NOT NULL DEFAULT '1.00',
  `onex` decimal(10,2) NOT NULL DEFAULT '1.00',
  `one2` decimal(10,2) NOT NULL DEFAULT '1.00',
  `X2` decimal(10,2) NOT NULL DEFAULT '1.00',
  `gg` decimal(10,2) NOT NULL DEFAULT '1.00',
  `ngg` decimal(10,2) NOT NULL DEFAULT '1.00',
  `dnb1` decimal(10,2) NOT NULL DEFAULT '1.00',
  `dnb2` decimal(10,2) NOT NULL DEFAULT '1.00',
  `ov25` decimal(10,2) NOT NULL DEFAULT '1.00',
  `ov35` decimal(10,2) NOT NULL DEFAULT '1.00',
  `ov15` decimal(10,2) NOT NULL DEFAULT '1.00',
  `ov05` decimal(10,2) NOT NULL DEFAULT '1.00',
  `un05` decimal(10,2) NOT NULL DEFAULT '1.00',
  `un15` decimal(10,2) NOT NULL DEFAULT '1.00',
  `un25` decimal(10,2) NOT NULL DEFAULT '1.00',
  `un35` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half1` decimal(10,2) NOT NULL DEFAULT '1.00',
  `halfX` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half2` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half1n1` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half1nx` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half1n2` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half2n1` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half2nx` decimal(10,2) NOT NULL DEFAULT '1.00',
  `half2n2` decimal(10,2) NOT NULL DEFAULT '1.00',
  `halfxn1` decimal(10,2) NOT NULL DEFAULT '1.00',
  `halfxnx` decimal(10,2) NOT NULL DEFAULT '1.00',
  `halfxn2` decimal(10,2) NOT NULL DEFAULT '1.00',
  `win2nillhome_yes` decimal(10,2) NOT NULL DEFAULT '1.00',
  `win2nillhome_no` decimal(10,2) NOT NULL DEFAULT '1.00',
  `win2nillaway_yes` decimal(10,2) NOT NULL DEFAULT '1.00',
  `win2nillaway_no` decimal(10,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`fixture_id`),
  CONSTRAINT `odds_table_ibfk_1` FOREIGN KEY (`fixture_id`) REFERENCES `markets_table` (`fixture_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
DROP TABLE IF EXISTS `users_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_table` (
  `user__id` varchar(12) NOT NULL,
  `user_number` varchar(11) NOT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `account_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`user__id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
DROP TABLE IF EXISTS `admintable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admintable` (
  `admin_id` varchar(15) NOT NULL,
  `account_balance` decimal(10,2) DEFAULT NULL,
  `amount_paid_in` decimal(10,2) DEFAULT NULL,
  `ammount_paid_out` decimal(10,2) DEFAULT NULL,
  `users_regis` int(11) DEFAULT NULL,
  `bets_won` int(11) DEFAULT NULL,
  `bets_lost` int(11) DEFAULT NULL,
  `betsplaces` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
DROP TABLE IF EXISTS `auth_tokes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_tokes` (
  `authid` int(11) NOT NULL AUTO_INCREMENT,
  `selector` char(12) DEFAULT NULL,
  `token` char(64) DEFAULT NULL,
  `userid` varchar(11) NOT NULL,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`authid`)
) ENGINE=InnoDB AUTO_INCREMENT=824 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
DROP TABLE IF EXISTS `league_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `league_table` (
  `league_id` varchar(25) NOT NULL,
  `league_name` varchar(30) NOT NULL,
  `country` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`league_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `bets_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bets_table` (
  `bet_id` varchar(20) NOT NULL,
  `user__id` varchar(12) NOT NULL,
  `bet_status` varchar(12) NOT NULL,
  `time_placed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bet_amount` int(10) NOT NULL,
  `possiblewin` decimal(10,2) NOT NULL,
  `total_odds` decimal(10,2) NOT NULL,
  PRIMARY KEY (`bet_id`),
  KEY `user_id` (`user__id`),
  CONSTRAINT `bets_table_ibfk_1` FOREIGN KEY (`user__id`) REFERENCES `users_table` (`user__id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
DROP TABLE IF EXISTS `betslip_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `betslip_table` (
  `betslip_id` varchar(12) NOT NULL,
  `bet_id` varchar(12) NOT NULL,
  `fixture_id` varchar(12) NOT NULL,
  `bet_value` varchar(1) NOT NULL,
  PRIMARY KEY (`betslip_id`),
  KEY `bet_id` (`bet_id`),
  KEY `market_id` (`fixture_id`),
  CONSTRAINT `betslip_table_ibfk_2` FOREIGN KEY (`bet_id`) REFERENCES `bets_table` (`bet_id`) ON DELETE CASCADE,
  CONSTRAINT `betslip_table_ibfk_3` FOREIGN KEY (`fixture_id`) REFERENCES `markets_table` (`fixture_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `transactions_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions_table` (
  `transaction_id` varchar(25) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `transaction_type` varchar(12) NOT NULL,
  `transaction_time` varchar(12) NOT NULL,
  `transaction_amount` bigint(20) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `transactions_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user__id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `password_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset` (
  `reset_id` int(11) NOT NULL AUTO_INCREMENT,
  `reset_user__id` varchar(12) CHARACTER SET utf8mb4 NOT NULL,
  `reset_token` varchar(12) NOT NULL,
  `expiry_date` varchar(22) NOT NULL,
  PRIMARY KEY (`reset_id`),
  KEY `reset_user__id` (`reset_user__id`),
  CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`reset_user__id`) REFERENCES `users_table` (`user__id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=544 DEFAULT CHARSET=utf8;
