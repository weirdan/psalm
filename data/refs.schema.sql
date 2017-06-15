BEGIN TRANSACTION;
CREATE TABLE `user_classes` (
	`fqcln`	TEXT NOT NULL UNIQUE,
	`file_path`	TEXT NOT NULL,
	PRIMARY KEY(`fqcln`)
);
CREATE TABLE `system_classes` (
	`fqcln`	TEXT NOT NULL UNIQUE,
	PRIMARY KEY(`fqcln`)
);
CREATE TABLE "files" (
	`path`	TEXT NOT NULL UNIQUE,
	`content_hash`	TEXT NOT NULL,
	PRIMARY KEY(`path`)
);
CREATE TABLE `file_references` (
	`id`	INTEGER NOT NULL UNIQUE,
	`path`	TEXT NOT NULL,
	`reference_fqcln`	TEXT NOT NULL,
	PRIMARY KEY(`id`)
);
CREATE TABLE `class_dependencies` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`fqcln`	TEXT NOT NULL,
	`dependency_fqcln`	TEXT NOT NULL
);
CREATE UNIQUE INDEX `file_to_class` ON `file_references` (`path` ,`reference_fqcln` );
CREATE UNIQUE INDEX `class_to_dependent` ON `class_dependencies` (`fqcln` ,`dependency_fqcln` );
CREATE INDEX `class_path` ON `user_classes` (`file_path` ASC);
COMMIT;
