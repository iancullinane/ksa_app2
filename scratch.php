-- MySQL Script generated by MySQL Workbench
-- 08/08/14 14:54:10
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ksa_one
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ksa_one` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ksa_one` ;

-- -----------------------------------------------------
-- Table `ksa_one`.`Competency`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`Competency` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`Competency` (
  `CompID` INT NOT NULL AUTO_INCREMENT,
  `Competency` VARCHAR(140) NOT NULL,
  PRIMARY KEY (`CompID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ksa_one`.`Certification`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`Certification` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`Certification` (
  `CertID` INT NOT NULL AUTO_INCREMENT,
  `CertBody` VARCHAR(200) NULL,
  `CertificateName` VARCHAR(140) NOT NULL,
  PRIMARY KEY (`CertID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ksa_one`.`Institution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`Institution` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`Institution` (
  `InstID` INT NOT NULL AUTO_INCREMENT,
  `InstitutionName` VARCHAR(140) NOT NULL,
  `CAE` VARCHAR(45) NULL,
  `IAE` VARCHAR(45) NULL,
  `2Y` VARCHAR(45) NULL,
  `R` VARCHAR(45) NULL,
  `ContactName` VARCHAR(45) NULL,
  `ContactEmail` VARCHAR(80) NULL,
  PRIMARY KEY (`InstID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ksa_one`.`Course`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`Course` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`Course` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Number` VARCHAR(10) NULL,
  `CourseName` VARCHAR(100) NULL,
  `OutcomeID` INT NULL,
  `InstID` INT NULL,
  PRIMARY KEY (`ID`),
  INDEX `InstID_idx` (`InstID` ASC),
  INDEX `OutcomeID_idx` (`OutcomeID` ASC),
  CONSTRAINT `InstID`
    FOREIGN KEY (`InstID`)
    REFERENCES `ksa_one`.`Institution` (`InstID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `ksa_one`.`Domain`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`Domain` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`Domain` (
  `DomainID` INT NOT NULL AUTO_INCREMENT,
  `DomainName` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`DomainID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ksa_one`.`Specialization`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`Specialization` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`Specialization` (
  `SpecID` INT NOT NULL AUTO_INCREMENT,
  `Specialization` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`SpecID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ksa_one`.`Task`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`Task` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`Task` (
  `TaskID` INT NOT NULL AUTO_INCREMENT,
  `Statement` TEXT NULL,
  `DomainID` INT NOT NULL,
  `SpecID` INT NOT NULL,
  PRIMARY KEY (`TaskID`),
  INDEX `DomainID_idx` (`DomainID` ASC),
  INDEX `SpecID_idx` (`SpecID` ASC),
  UNIQUE INDEX `SpecID_UNIQUE` (`SpecID` ASC),
  UNIQUE INDEX `DomainID_UNIQUE` (`DomainID` ASC),
    FOREIGN KEY (`DomainID`)
    REFERENCES `ksa_one`.`Domain` (`DomainID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`SpecID`)
    REFERENCES `ksa_one`.`Specialization` (`SpecID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ksa_one`.`KSA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`KSA` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`KSA` (
  `KSA_ID` INT NOT NULL,
  `Statement` TEXT NULL,
  `CompID` INT NULL,
  `CertID` INT NULL,
  `DomainID` INT NULL,
  `SpecID` INT NULL,
  PRIMARY KEY (`KSA_ID`),
  INDEX `CompID_idx` (`CompID` ASC),
  INDEX `CertID_idx` (`CertID` ASC),
  INDEX `DomainID_idx` (`DomainID` ASC),
  INDEX `SpecID_idx` (`SpecID` ASC),
  CONSTRAINT `DomainID`
    FOREIGN KEY (`DomainID`)
    REFERENCES `ksa_one`.`Domain` (`DomainID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `SpecID`
    FOREIGN KEY (`SpecID`)
    REFERENCES `ksa_one`.`Specialization` (`SpecID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `CompID`
    FOREIGN KEY (`CompID`)
    REFERENCES `ksa_one`.`Competency` (`CompID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `CertID`
    FOREIGN KEY (`CertID`)
    REFERENCES `ksa_one`.`Certification` (`CertID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ksa_one`.`CourseOutcome`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ksa_one`.`CourseOutcome` ;

CREATE TABLE IF NOT EXISTS `ksa_one`.`CourseOutcome` (
  `OutcomeID` INT NOT NULL,
  `KSA_ID` INT NOT NULL,
  `TaskID` INT NOT NULL,
  `CertID` INT NOT NULL,
  PRIMARY KEY (`OutcomeID`),
  INDEX `KSA_ID` (`KSA_ID` ASC),
  UNIQUE INDEX `KSA_ID_UNIQUE` (`KSA_ID` ASC),
  INDEX `TaskID_idx` (`TaskID` ASC),
  INDEX `CertID_idx` (`CertID` ASC),
    FOREIGN KEY (`OutcomeID`)
    REFERENCES `ksa_one`.`Course` (`OutcomeID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (`TaskID`)
    REFERENCES `ksa_one`.`Task` (`TaskID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`CertID`)
    REFERENCES `ksa_one`.`Certification` (`CertID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`KSA_ID`)
    REFERENCES `ksa_one`.`KSA` (`KSA_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;










/*FILE FOR CREATING THE DATABASE ON THE FLY*/


/*call the file to insert competencies*/
SOURCE /sql/competency_insert;


/*regex for thing*/
(^\d*)(\s*.*)
INSERT IGNORE INTO `ksa_one`.`KSA` (`KSA_ID`, `Statement`) VALUES ( "$1", "$2");

(", ")(\s*)





/*insert into institution table*/
INSERT INTO `ksa_one`.`Institution` (`InstitutionName`) VALUES ('Lake Champlain');

/*insertcourse data*/
INSERT INTO ksa_one.course (CourseNumber, courseName)
VALUES
('CIT130','CIT130'),
('CIT135','CIT135'),
('CIT140','CIT140'),
('FOR240','FOR240'),
('FOR270','FOR270'),
('FOR320','FOR320'),
('FOR340','FOR340'),
('NET215','NET215'),
('NET225','NET225'),
('NET255','NET255'),
('NET265','NET265'),
('NET320','NET320'),
('SEC350','SEC350'),
('SEC250','SEC250'),
('SEC335','SEC335'),
('SEC345','SEC345'),
('SEC440','SEC440');


/*INSERT into course table*/
INSERT INTO `ksa_one`.`Course` (`Number`, `CourseName`, `OutcomeID`, `InstID`) VALUES ('CIT130', 'CIT130', 1, 1);

/*load data into ksa*/
LOAD DATA LOCAL INFILE 'C:/Users/Ian/Desktop/sql/rand/ksa_full_load2.txt' INTO TABLE ksa_one.ksa  FIELDS terminated by '||' LINES TERMINATED BY '\r\n';


/*insert the domains*/
INSERT INTO ksa_one.domain (DomainName) 
VALUES
('Securely Provision'),
('Operate and Maintain'),
('Protect and Defend'),
('Investigate'),
('Collect and Operate'),
('Analyze'),
('Oversight and Development');

