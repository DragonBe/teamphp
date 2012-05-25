--
-- Account data
--
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `twitterId` INT UNSIGNED NOT NULL,
    `twitterName` VARCHAR(255) NOT NULL,
    `token` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) Engine=MyIsam CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci';