-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema accident_investigation
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema accident_investigation
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `accident_investigation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `accident_investigation` ;

-- -----------------------------------------------------
-- Table `accident_investigation`.`study`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`study` (
  `study_id` INT NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `taxonomy_file` VARCHAR(255) NOT NULL,
  `report_file` VARCHAR(255) NOT NULL,
  `annotated_report` TEXT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT now(),
  PRIMARY KEY (`study_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `accident_investigation`.`dimension`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`dimension` (
  `dimension_id` INT NOT NULL,
  `study_id` INT NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`dimension_id`),
  INDEX `fk_dimension_study_idx` (`study_id` ASC) VISIBLE,
  CONSTRAINT `fk_dimension_study`
    FOREIGN KEY (`study_id`)
    REFERENCES `accident_investigation`.`study` (`study_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `accident_investigation`.`factor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`factor` (
  `factor_id` INT NOT NULL AUTO_INCREMENT,
  `dimension_id` INT NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`factor_id`),
  INDEX `fk_factor_dimension_idx` (`dimension_id` ASC) VISIBLE,
  CONSTRAINT `fk_factor_dimension`
    FOREIGN KEY (`dimension_id`)
    REFERENCES `accident_investigation`.`dimension` (`dimension_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `accident_investigation`.`term`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`term` (
  `term_id` INT NOT NULL AUTO_INCREMENT,
  `factor_id` INT NOT NULL,
  `preferred_term` VARCHAR(200) NOT NULL,
  `search_term` VARCHAR(200) NOT NULL,
  `frequency` INT NOT NULL,
  PRIMARY KEY (`term_id`),
  INDEX `fk_term_factor_idx` (`factor_id` ASC) VISIBLE,
  CONSTRAINT `fk_term_factor`
    FOREIGN KEY (`factor_id`)
    REFERENCES `accident_investigation`.`factor` (`factor_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `accident_investigation`.`relation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`relation` (
  `source_term_id` INT NOT NULL,
  `target_term_id` INT NOT NULL,
  `value` INT NOT NULL,
  INDEX `fk_relation_term_1_idx` (`source_term_id` ASC) VISIBLE,
  INDEX `fk_relation_term_2_idx` (`target_term_id` ASC) VISIBLE,
  PRIMARY KEY (`source_term_id`, `target_term_id`),
  CONSTRAINT `fk_relation_term`
    FOREIGN KEY (`source_term_id`)
    REFERENCES `accident_investigation`.`term` (`term_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relation_term2`
    FOREIGN KEY (`target_term_id`)
    REFERENCES `accident_investigation`.`term` (`term_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `accident_investigation`.`paragraph`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`paragraph` (
  `paragraph_id` INT NOT NULL AUTO_INCREMENT,
  `study_id` INT NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`paragraph_id`),
  INDEX `fk_paragraph_study_idx` (`study_id` ASC) VISIBLE,
  CONSTRAINT `fk_paragraph_study`
    FOREIGN KEY (`study_id`)
    REFERENCES `accident_investigation`.`study` (`study_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `accident_investigation`.`paragraph_term`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`paragraph_term` (
  `paragraph_id` INT NOT NULL,
  `term_id` INT NOT NULL,
  `offsets` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`paragraph_id`, `term_id`),
  INDEX `fk_paragraph_term_paragraph_idx` (`paragraph_id` ASC) VISIBLE,
  INDEX `fk_paragraph_term_term_idx` (`term_id` ASC) VISIBLE,
  CONSTRAINT `fk_term_has_paragraph_paragraph`
    FOREIGN KEY (`paragraph_id`)
    REFERENCES `accident_investigation`.`paragraph` (`paragraph_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_paragraph_content_term`
    FOREIGN KEY (`term_id`)
    REFERENCES `accident_investigation`.`term` (`term_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `accident_investigation`.`factor_term_relation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`factor_term_relation` (
  `factor_id` INT NULL,
  `source_term_id` INT NULL,
  `target_term_id` INT NULL,
  `value` INT NOT NULL,
  INDEX `fk_table1_factor1_idx` (`factor_id` ASC) VISIBLE,
  INDEX `fk_table1_term1_idx` (`source_term_id` ASC) VISIBLE,
  INDEX `fk_table1_term2_idx` (`target_term_id` ASC) VISIBLE,
  CONSTRAINT `fk_factor_term_relation_factor`
    FOREIGN KEY (`factor_id`)
    REFERENCES `accident_investigation`.`factor` (`factor_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_factor_term_relation_term_1`
    FOREIGN KEY (`source_term_id`)
    REFERENCES `accident_investigation`.`term` (`term_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_factor_term_relation_term_2`
    FOREIGN KEY (`target_term_id`)
    REFERENCES `accident_investigation`.`term` (`term_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `accident_investigation`.`visualization`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accident_investigation`.`visualization` (
  `study_id` INT NOT NULL,
  `visualization_id` INT NOT NULL,
  `text` TEXT NOT NULL,
  PRIMARY KEY (`study_id`, `visualization_id`),
  CONSTRAINT `fk_visualization_study1`
    FOREIGN KEY (`study_id`)
    REFERENCES `accident_investigation`.`study` (`study_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
