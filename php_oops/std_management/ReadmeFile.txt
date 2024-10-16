to make foreign key use query 
ALTER TABLE `std_parent` 
ADD CONSTRAINT fk_parents 
FOREIGN KEY (`parent_id`) REFERENCES `parents` (`p_id`);

and with cascade or null use this but before make sure 

first condition is fulfilled
ALTER TABLE `std_parent` 
MODIFY `parent_id` int(11) unsigned NULL;

then 

ALTER TABLE `std_course` 
ADD CONSTRAINT fk_courses 
FOREIGN KEY (`student_id`) REFERENCES `std` (`std_id`) 
ON DELETE SET NULL 
ON UPDATE SET NULL;



remember customize query according to your table 