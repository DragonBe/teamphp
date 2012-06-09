SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `teamphp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `teamphp` ;

-- -----------------------------------------------------
-- Table `teamphp`.`account`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `teamphp`.`account` (
  `twitterId` BIGINT UNSIGNED NOT NULL ,
  `screenName` VARCHAR(45) NOT NULL ,
  `userName` VARCHAR(150) NOT NULL ,
  `accessToken` VARCHAR(45) NULL ,
  `accessTokenSecret` VARCHAR(45) NULL ,
  PRIMARY KEY (`twitterId`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamphp`.`subscription`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `teamphp`.`subscription` (
  `parentId` BIGINT UNSIGNED NOT NULL COMMENT 'This is the twitterId for the parent account' ,
  `childId` BIGINT UNSIGNED NOT NULL COMMENT 'This is the twitter id for the child account' ,
  PRIMARY KEY (`parentId`, `childId`) ,
  INDEX `subscription_parent_fk` (`parentId` ASC) ,
  INDEX `subscription_child_fk` (`childId` ASC) ,
  CONSTRAINT `subscription_parent_fk`
    FOREIGN KEY (`parentId` )
    REFERENCES `teamphp`.`account` (`twitterId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `subscription_child_fk`
    FOREIGN KEY (`childId` )
    REFERENCES `teamphp`.`account` (`twitterId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
