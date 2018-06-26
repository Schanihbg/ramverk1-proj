DROP TABLE IF EXISTS ramverk1_proj_comment;
CREATE TABLE `ramverk1_proj_comment` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userID` INTEGER NOT NULL,
    `comment` varchar(255) DEFAULT NULL,
    `parentID` INTEGER DEFAULT 0,
    `postID` INTEGER DEFAULT 0
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
