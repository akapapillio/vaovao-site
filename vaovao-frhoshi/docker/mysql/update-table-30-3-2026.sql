
USE news_db0000;
ALTER TABLE admins ADD COLUMN nom VARCHAR(50) NOT NULL AFTER id;
UPDATE admins 
SET nom = 'admin' 
WHERE email = 'admin@mail.com';