CREATE TABLE IF NOT EXISTS `transactions` (
    `id` INT(6) UNSIGNED AUTO_INCREMENT,
    `data` VARBINARY(410) NOT NULL,
    PRIMARY KEY(`id`) 
);