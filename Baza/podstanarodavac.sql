-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema podstanarodavac
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema podstanarodavac
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `podstanarodavac` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema skripta
-- -----------------------------------------------------
USE `podstanarodavac` ;

-- -----------------------------------------------------
-- Table `podstanarodavac`.`Oglasna_tabla`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `podstanarodavac`.`Oglasna_tabla` (
  `IDO` INT NOT NULL,
  `Naslov` VARCHAR(18) NULL,
  `Tekst` VARCHAR(108) NULL,
  PRIMARY KEY (`IDO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `podstanarodavac`.`Korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `podstanarodavac`.`Korisnik` (
  `IDK` INT NOT NULL,
  `Ime` VARCHAR(45) NULL,
  `Prezime` VARCHAR(45) NULL,
  `Mail` VARCHAR(45) NULL,
  `Lozinka` VARCHAR(45) NULL,
  `JMBG` VARCHAR(45) NULL,
  `BrojTelefona` VARCHAR(45) NULL,
  `Adresa` VARCHAR(45) NULL,
  `Tip` VARCHAR(1) NULL,
  `Pol` VARCHAR(1) NULL,
  `IDO` INT NOT NULL,
  PRIMARY KEY (`IDK`),
  INDEX `fk_Korisnik_Oglasna_tabla1_idx` (`IDO` ASC),
  CONSTRAINT `fk_Korisnik_Oglasna_tabla1`
    FOREIGN KEY (`IDO`)
    REFERENCES `podstanarodavac`.`Oglasna_tabla` (`IDO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `podstanarodavac`.`Zakup`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `podstanarodavac`.`Zakup` (
  `IDZ` INT NOT NULL,
  `IDValsnika` INT NOT NULL,
  `IDStanara` INT NOT NULL,
  `AdresaStana` VARCHAR(45) NULL,
  `Kirija` INT NULL,
  `TrajanjeZakupa/Mesec` INT NULL,
  `DatumPocetkaZakupa` DATETIME NULL,
  `Kvadratura` INT NULL,
  `Prihvacen` TINYINT NULL,
  PRIMARY KEY (`IDZ`, `IDValsnika`, `IDStanara`),
  INDEX `fk_Zakup_Korisnik1_idx` (`IDValsnika` ASC),
  INDEX `fk_Zakup_Korisnik2_idx` (`IDStanara` ASC),
  CONSTRAINT `fk_Zakup_Korisnik1`
    FOREIGN KEY (`IDValsnika`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Zakup_Korisnik2`
    FOREIGN KEY (`IDStanara`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `podstanarodavac`.`Racun`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `podstanarodavac`.`Racun` (
  `IDR` INT NOT NULL,
  `SvrhaUplate` VARCHAR(40) NULL,
  `PozivNaBroj` VARCHAR(18) NULL,
  `ZiroRacun` VARCHAR(30) NULL,
  `Iznos` INT NULL,
  `IDVlasnika` INT NOT NULL,
  `IDStanara` INT NOT NULL,
  PRIMARY KEY (`IDR`),
  INDEX `fk_Racun_Korisnik1_idx` (`IDVlasnika` ASC),
  INDEX `fk_Racun_Korisnik2_idx` (`IDStanara` ASC),
  CONSTRAINT `fk_Racun_Korisnik1`
    FOREIGN KEY (`IDVlasnika`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Racun_Korisnik2`
    FOREIGN KEY (`IDStanara`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `podstanarodavac`.`Obavestenje_opomena`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `podstanarodavac`.`Obavestenje_opomena` (
  `IDO` INT NOT NULL,
  `IDValsnika` INT NOT NULL,
  `IDStanara` INT NOT NULL,
  `Naslov` VARCHAR(18) NULL,
  `Tekst` VARCHAR(100) NULL,
  `Vrsta` VARCHAR(18) NULL,
  PRIMARY KEY (`IDO`, `IDValsnika`, `IDStanara`),
  INDEX `fk_Obavestenje_opomena_Korisnik1_idx` (`IDValsnika` ASC),
  INDEX `fk_Obavestenje_opomena_Korisnik2_idx` (`IDStanara` ASC),
  CONSTRAINT `fk_Obavestenje_opomena_Korisnik1`
    FOREIGN KEY (`IDValsnika`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Obavestenje_opomena_Korisnik2`
    FOREIGN KEY (`IDStanara`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `podstanarodavac`.`Kvar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `podstanarodavac`.`Kvar` (
  `IDKvar` INT NOT NULL,
  `Naslov` VARCHAR(18) NULL,
  `Opis` VARCHAR(100) NULL,
  `IDVlasnika` INT NOT NULL,
  `IDStanara` INT NOT NULL,
  PRIMARY KEY (`IDKvar`),
  INDEX `fk_Kvar_Korisnik1_idx` (`IDVlasnika` ASC),
  INDEX `fk_Kvar_Korisnik2_idx` (`IDStanara` ASC),
  CONSTRAINT `fk_Kvar_Korisnik1`
    FOREIGN KEY (`IDVlasnika`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Kvar_Korisnik2`
    FOREIGN KEY (`IDStanara`)
    REFERENCES `podstanarodavac`.`Korisnik` (`IDK`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
