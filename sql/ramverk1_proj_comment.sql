DROP TABLE IF EXISTS ramverk1_proj_comment;
CREATE TABLE `ramverk1_proj_comment` (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userID` INTEGER NOT NULL,
    `comment` varchar(255) DEFAULT NULL,
    `parentID` INTEGER DEFAULT 0,
    `postID` INTEGER DEFAULT 0,
    `is_post` INTEGER DEFAULT 0,
    `post_title` varchar(255) DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DROP PROCEDURE IF EXISTS getComments;
DELIMITER //
CREATE PROCEDURE getComments
(IN inputID INT)
BEGIN
    SELECT * FROM `ramverk1_proj_comment`
    WHERE id IN
    (SELECT postID FROM `ramverk1_proj_comment` WHERE `userID` = inputID)
    OR id IN (SELECT id FROM `ramverk1_proj_comment` WHERE `userID` = inputID);
END //
DELIMITER ;
