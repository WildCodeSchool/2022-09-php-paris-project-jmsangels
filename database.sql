-- MySQL Script generated by MySQL Workbench
-- mar. 08 nov. 2022 14:27:32
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema knowledge
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema knowledge
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `knowledge` ;
USE `knowledge` ;

-- -----------------------------------------------------
-- Table `knowledge`.`theme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`theme` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `knowledge`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`subject` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `theme_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subject_idx` (`theme_id` ASC) VISIBLE,
  CONSTRAINT `fk_subject`
    FOREIGN KEY (`theme_id`)
    REFERENCES `knowledge`.`theme` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `knowledge`.`notion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`notion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `name` VARCHAR(45) NULL,
  `lesson` TEXT NULL,
  `sample` TEXT NULL,
  `subject_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_notion_1_idx` (`subject_id` ASC) VISIBLE,
  CONSTRAINT `fk_notion_1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `knowledge`.`subject` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `knowledge`.`exercise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `knowledge`.`exercise` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `url` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `notion_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_exercise_1_idx` (`notion_id` ASC) VISIBLE,
  CONSTRAINT `fk_exercise_1`
    FOREIGN KEY (`notion_id`)
    REFERENCES `knowledge`.`notion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
