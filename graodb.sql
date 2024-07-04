-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema grao-co
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `grao-co` DEFAULT CHARACTER SET utf8 ;
USE `grao-co` ;

-- -----------------------------------------------------
-- Table `grao-co`.`plans`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`plans` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grao-co`.`usersCategories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`usersCategories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grao-co`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `plans_id` INT NOT NULL,
  `usersCategories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_plans_idx` (`plans_id` ASC),
  INDEX `fk_users_usersCategories1_idx` (`usersCategories_id` ASC),
  CONSTRAINT `fk_users_plans`
    FOREIGN KEY (`plans_id`)
    REFERENCES `grao-co`.`plans` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_usersCategories1`
    FOREIGN KEY (`usersCategories_id`)
    REFERENCES `grao-co`.`usersCategories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grao-co`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grao-co`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `value` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `quantity` INT NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_products_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_products_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `grao-co`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grao-co`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`order` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `total` DECIMAL(10,2) NOT NULL,
  `quantity` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_order_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `grao-co`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grao-co`.`coments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`coments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rating` INT NOT NULL,
  `review` TEXT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_coments_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_coments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `grao-co`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `grao-co`.`payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grao-co`.`payments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order_id` INT NOT NULL,
  `products_id` INT NOT NULL,
  PRIMARY KEY (`id`, `order_id`, `products_id`),
  INDEX `fk_order_has_products_products1_idx` (`products_id` ASC),
  INDEX `fk_order_has_products_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_has_products_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `grao-co`.`order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_has_products_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `grao-co`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;