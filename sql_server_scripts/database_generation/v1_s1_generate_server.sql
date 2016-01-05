CREATE TABLE `creature_attribute`  ( 
	`id`                        	int(11) AUTO_INCREMENT NOT NULL,
	`name`                      	varchar(25) NOT NULL,
	`creature_attribute_type_id`	int(11) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_attribute_type`  ( 
	`id`  	int(11) AUTO_INCREMENT NOT NULL,
	`name`	varchar(25) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_class`  ( 
	`id`  	int(11) AUTO_INCREMENT NOT NULL,
	`name`	varchar(50) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_stat_levels`  ( 
	`id`       	int(11) AUTO_INCREMENT NOT NULL,
	`stat_id`  	int(11) NOT NULL,
	`rank`     	int(3) NOT NULL,
	`rank_name`	varchar(25) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_stats`  ( 
	`id`        	int(11) AUTO_INCREMENT NOT NULL,
	`name`      	varchar(20) NOT NULL,
	`short_name`	varchar(10) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_tier_and_creature_attribute`  ( 
	`id`                   	int(11) AUTO_INCREMENT NOT NULL,
	`creature_tier_id`     	int(11) NOT NULL,
	`creature_attribute_id`	int(11) NULL,
	`number`               	int(11) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_tier_diet`  ( 
	`id`  	int(11) AUTO_INCREMENT NOT NULL,
	`name`	varchar(25) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_tier_disposition`  ( 
	`id`  	int(11) AUTO_INCREMENT NOT NULL,
	`name`	varchar(25) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_tier_hunting_style`  ( 
	`id`  	int(11) AUTO_INCREMENT NOT NULL,
	`name`	varchar(50) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_tier_social`  ( 
	`id`  	int(11) AUTO_INCREMENT NOT NULL,
	`name`	varchar(50) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_tiers`  ( 
	`id`                            	int(11) AUTO_INCREMENT NOT NULL,
	`name`                          	varchar(50) NOT NULL,
	`creature_type_id`              	int(11) NOT NULL,
	`tier`                          	int(3) NOT NULL,
	`creature_tier_diet_id`         	int(11) NULL,
	`creature_tier_disposition_id`  	int(11) NULL,
	`creature_tier_hunting_style_id`	int(11) NULL,
	`creature_tier_social_id`       	int(11) NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE TABLE `creature_tiers_and_stats`  ( 
	`creature_tier_id`      	int(11) NOT NULL,
	`creature_stat_level_id`	int(11) NOT NULL 
	)
GO
CREATE TABLE `creature_type`  ( 
	`id`  	int(11) AUTO_INCREMENT NOT NULL,
	`name`	varchar(50) NOT NULL,
	PRIMARY KEY(`id`)
)
GO
CREATE VIEW `creature`
AS
select `tier`.`id` AS `id`,`tier`.`name` AS `name`,`tier`.`tier` AS `tier`,`type`.`name` AS `type`,`diet`.`name` AS `diet`,`disposition`.`name` AS `disposition`,`hunting_style`.`name` AS `hunting_style` from (((((`bslyblue_BattleChores`.`creature_tiers` `tier` left join `bslyblue_BattleChores`.`creature_type` `type` on((`tier`.`creature_type_id` = `type`.`id`))) left join `bslyblue_BattleChores`.`creature_tier_diet` `diet` on((`diet`.`id` = `tier`.`creature_tier_diet_id`))) left join `bslyblue_BattleChores`.`creature_tier_disposition` `disposition` on((`disposition`.`id` = `tier`.`creature_tier_disposition_id`))) left join `bslyblue_BattleChores`.`creature_tier_hunting_style` `hunting_style` on((`hunting_style`.`id` = `tier`.`creature_tier_disposition_id`))) left join `bslyblue_BattleChores`.`creature_tier_social` `social` on((`social`.`id` = `tier`.`creature_tier_social_id`)))
GO

CREATE INDEX `creature_attribute_ibfk_1` USING BTREE 
	ON `creature_attribute`(`creature_attribute_type_id`)
GO
CREATE INDEX `creature_stat_levels_ibfk_1` USING BTREE 
	ON `creature_stat_levels`(`stat_id`)
GO
CREATE INDEX `creature_tier_and_creature_attribute_ibfk_1` USING BTREE 
	ON `creature_tier_and_creature_attribute`(`creature_attribute_id`)
GO
CREATE INDEX `creature_tier_and_creature_attribute_ibfk_2` USING BTREE 
	ON `creature_tier_and_creature_attribute`(`creature_tier_id`)
GO
CREATE INDEX `creature_tiers_ibfk_3` USING BTREE 
	ON `creature_tiers`(`creature_tier_diet_id`)
GO
CREATE INDEX `creature_tiers_ibfk_4` USING BTREE 
	ON `creature_tiers`(`creature_tier_disposition_id`)
GO
CREATE INDEX `creature_tiers_ibfk_5` USING BTREE 
	ON `creature_tiers`(`creature_tier_hunting_style_id`)
GO
CREATE INDEX `creature_tiers_ibfk_6` USING BTREE 
	ON `creature_tiers`(`creature_tier_social_id`)
GO
CREATE INDEX `creature_type_id` USING BTREE 
	ON `creature_tiers`(`creature_type_id`)
GO
CREATE INDEX `creature_type_id_2` USING BTREE 
	ON `creature_tiers`(`creature_type_id`)
GO
CREATE INDEX `creature_tier_id` USING BTREE 
	ON `creature_tiers_and_stats`(`creature_tier_id`)
GO
CREATE INDEX `stat_id` USING BTREE 
	ON `creature_tiers_and_stats`(`creature_stat_level_id`)
GO
CREATE INDEX `id_2` USING BTREE 
	ON `creature_type`(`id`)
GO
CREATE INDEX `id_3` USING BTREE 
	ON `creature_type`(`id`)
GO
ALTER TABLE `creature_stat_levels`
	ADD CONSTRAINT `id`
	UNIQUE (`id`)
GO
ALTER TABLE `creature_stats`
	ADD CONSTRAINT `id`
	UNIQUE (`id`)
GO
ALTER TABLE `creature_type`
	ADD CONSTRAINT `name`
	UNIQUE (`name`)
GO
ALTER TABLE `creature_type`
	ADD CONSTRAINT `id`
	UNIQUE (`id`)
GO
ALTER TABLE `creature_attribute`
	ADD CONSTRAINT `creature_attribute_ibfk_1`
	FOREIGN KEY(`creature_attribute_type_id`)
	REFERENCES `creature_attribute_type`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_stat_levels`
	ADD CONSTRAINT `creature_stat_levels_ibfk_1`
	FOREIGN KEY(`stat_id`)
	REFERENCES `creature_stats`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tier_and_creature_attribute`
	ADD CONSTRAINT `creature_tier_and_creature_attribute_ibfk_2`
	FOREIGN KEY(`creature_tier_id`)
	REFERENCES `creature_tiers`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tier_and_creature_attribute`
	ADD CONSTRAINT `creature_tier_and_creature_attribute_ibfk_1`
	FOREIGN KEY(`creature_attribute_id`)
	REFERENCES `creature_attribute`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tiers`
	ADD CONSTRAINT `creature_tiers_ibfk_6`
	FOREIGN KEY(`creature_tier_social_id`)
	REFERENCES `creature_tier_social`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tiers`
	ADD CONSTRAINT `creature_tiers_ibfk_5`
	FOREIGN KEY(`creature_tier_hunting_style_id`)
	REFERENCES `creature_tier_hunting_style`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tiers`
	ADD CONSTRAINT `creature_tiers_ibfk_4`
	FOREIGN KEY(`creature_tier_disposition_id`)
	REFERENCES `creature_tier_disposition`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tiers`
	ADD CONSTRAINT `creature_tiers_ibfk_3`
	FOREIGN KEY(`creature_tier_diet_id`)
	REFERENCES `creature_tier_diet`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tiers`
	ADD CONSTRAINT `creature_tiers_ibfk_2`
	FOREIGN KEY(`creature_type_id`)
	REFERENCES `creature_type`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tiers_and_stats`
	ADD CONSTRAINT `creature_tiers_and_stats_ibfk_2`
	FOREIGN KEY(`creature_stat_level_id`)
	REFERENCES `creature_stat_levels`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
ALTER TABLE `creature_tiers_and_stats`
	ADD CONSTRAINT `creature_tiers_and_stats_ibfk_1`
	FOREIGN KEY(`creature_tier_id`)
	REFERENCES `creature_tiers`(`id`)
	ON DELETE RESTRICT 
	ON UPDATE RESTRICT 
GO
