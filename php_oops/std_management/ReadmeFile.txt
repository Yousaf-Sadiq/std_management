to make foreign key use query 


ALTER TABLE `std_parent` 
ADD CONSTRAINT fk_parents 
FOREIGN KEY (`parent_id`) REFERENCES `parents` (`p_id`);

and with cascade or null use this but before make sure 

first condition is fulfilled


ALTER TABLE `admins` 
MODIFY `address_id` int(11) unsigned NULL;

then 

ALTER TABLE `admins`
 
ADD CONSTRAINT fk_courses 
FOREIGN KEY (`address_id`) REFERENCES `addresses` (`adrs_id`) 
ON DELETE SET NULL 
ON UPDATE SET NULL;



remember customize query according to your table 

ALTER TABLE `addresses`
ADD CONSTRAINT admins_user_id_foreign
FOREIGN KEY (`user_id`) REFERENCES `admins` (`admin_id`) 
ON DELETE SET NULL 
ON UPDATE SET NULL;