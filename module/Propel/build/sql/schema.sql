
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- autor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `autor`;

CREATE TABLE `autor`
(
    `idautor` INTEGER NOT NULL AUTO_INCREMENT,
    `autor_nombre` VARCHAR(45) NOT NULL,
    `autor_pais` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`idautor`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- editorial
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `editorial`;

CREATE TABLE `editorial`
(
    `ideditorial` INTEGER NOT NULL AUTO_INCREMENT,
    `editorial_nombre` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`ideditorial`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- libro
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `libro`;

CREATE TABLE `libro`
(
    `idlibro` INTEGER NOT NULL AUTO_INCREMENT,
    `libro_nombre` VARCHAR(45) NOT NULL,
    `idautor` INTEGER NOT NULL,
    `ideditorial` INTEGER NOT NULL,
    PRIMARY KEY (`idlibro`),
    INDEX `idautor` (`idautor`),
    INDEX `ideditorial` (`ideditorial`),
    CONSTRAINT `libro_idautor`
        FOREIGN KEY (`idautor`)
        REFERENCES `autor` (`idautor`),
    CONSTRAINT `libro_ideditorial`
        FOREIGN KEY (`ideditorial`)
        REFERENCES `editorial` (`ideditorial`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- usuario
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario`
(
    `idusuario` INTEGER NOT NULL AUTO_INCREMENT,
    `usuario_nombre` VARCHAR(45) NOT NULL,
    `usario_password` VARCHAR(45) NOT NULL,
    `usuario_nickname` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`idusuario`),
    UNIQUE INDEX `usuario_nickname_UNIQUE` (`usuario_nickname`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
