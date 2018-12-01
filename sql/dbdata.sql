
# LOGIN_DATA(username,password_sha,last_login,num_failed_attempts)
INSERT INTO Login_data VALUES ("john1","abc123",null,0);
INSERT INTO Login_data VALUES ("jane1","cde456",null,0);
INSERT INTO Login_data VALUES ("catsrcool","abc123",null,0);
INSERT INTO Login_data VALUES ("immaparent","cde456",null,0);

# USER(username,email,phone,first_name,last_name)
INSERT INTO User VALUES ("john1","john.doe@gmail.com",4031112222,"John","Doe");
INSERT INTO User VALUES ("jane1","jane.kim@gmail.com",4033334444,"Jane","Kim");
INSERT INTO User VALUES ("catsrcool","cats.r.cool@gmail.com",4031234567,"Jackson","Galaxy");
INSERT iNTO User VALUES ("immaparent","imma.parent@gmail.com",4032345678,"Claire","Dunphy");

# PARENT(username)
INSERT INTO Parent VALUES ("catsrcool");
INSERT INTO Parent VALUES ("immaparent");

# TUTOR(username,bio,education,house_num,street,city,postal_code)
INSERT INTO Tutor VALUES ("john1", "I like math and children struggling with math.",
                            "Third year student, University of Calgary, Majoring in Mathematics", 21, 
                            "Penny Lane SE", "Calgary", "A1B 2C3");
INSERT INTO Tutor VALUES ("jane1", "I like biology, animals, and the biology of animals.", 
                            "Fourth year student, University of Calgary Faculty of Veterinary Medicine",
                            123, "Hawkwood Drive NW", "Calgary", "D4E 5F6");

# TOPIC(topic_id,name,description)
INSERT INTO Topic VALUES ("math", "Mathematics", 
    "The science that explains numbers, quantities, measurements, and the relations between them.");
INSERT INTO Topic VALUES ("phys", "Physics",
    "The branch of science concerned with the nature and properties of matter and energy.");
INSERT INTO Topic VALUES ("biol", "Biology",
    "The study of living organisms, divided into many specialized fields that cover their morphology, physiology, anatomy, behavior, origin, and distribution.");
INSERT INTO Topic VALUES ("chem", "Chemistry",
    "The branch of science that deals with the identification of the substances of which matter is composed.");
INSERT INTO Topic VALUES ("engl", "English",
    "English and language arts in five basic categories: reading, writing, speaking, listening and viewing.");

# TUTOR_TOPIC_KNOWLEDGE(username, topic_id, knowledge_level)
INSERT INTO Tutor_topic_knowledge("john1","math",10);
INSERT INTO Tutor_topic_knowledge("john1","phys",9);
INSERT INTO Tutor_topic_knowledge("jane1","biol",10);
INSERT INTO Tutor_topic_knowledge("jane1","chem",8);
INSERT INTO Tutor_topic_knowledge("jane1","engl",6);

# REVIEWS(parent_uname, tutor_uname, timestamp, comment, rating) **Assuming timestamp self populates
INSERT INTO Reviews(parent_uname, tutor_uname, comment, rating) VALUES ("catsrcool", "john1", 
    "Very knowledgable about mathematics. My son liked him a lot and always enjoyed his sessions. Grades are improving.",
    5);
INSERT INTO Reviews(parent_uname, tutor_uname, comment, rating) VALUES ("catsrcool", "jane1",
    "Very nice person, but her knowledge in English is quite limited... Basically paying her to teach at my own level.",
    2);
INSERT INTO Reviews(parent_uname, tutor_uname, comment, rating) VALUES ("immaparent", "john1",
    "This guy is not a physics major, but still has a very good understanding of it. Good at teaching high school level.",
    4);
INSERT INTO Reviews(parent_uname, tutor_uname, comment, rating) VALUES ("immaparent", "jane1",
    "She kept my kid engaged with her insane collection of cool animal facts! My kid now wants to go into biology like her.",
    5);

# STUDENT(student_id, dob, first_name, last_name, parent_uname) **Assuming student_id self populates
INSERT INTO Student(dob, first_name, last_name, parent_uname) VALUES ('2005-01-05', "Luke", "Galaxy", "catsrcool");
INSERT INTO Student(dob, first_name, last_name, parent_uname) VALUES ('2006-12-03', "Annika", "Galaxy", "catsrcool");
INSERT INTO Student(dob, first_name, last_name, parent_uname) VALUES ('1998-04-23', "Haley", "Dunphy", "immaparent");
INSERT INTO Student(dob, first_name, last_name, parent_uname) VALUES ('2002-06-14', "Alex", "Dunphy", "immaparent");

# CLASS(class_id, name, description, enroll_open, tutor_uname, topic) **Assuming class_id self populates
INSERT INTO Class(name, description, enroll_open, tutor_uname, topic) 
    VALUES ("Mathematics 30-1", "High School grade 12 math.", FALSE, "john1", "math");
INSERT INTO Class(name, description, enroll_open, tutor_uname, topic) 
    VALUES ("Physics 20-1", "High School grade 11 physics.", TRUE, "john1", "phys");
INSERT INTO Class(name, description, enroll_open, tutor_uname, topic) 
    VALUES ("Biology 35-1", "High School grade 12 AP biology. AP prep available.", TRUE, "jane1", "biol");
INSERT INTO Class(name, description, enroll_open, tutor_uname, topic) 
    VALUES ("Chemistry 20-1", "High School grade 11 chemestry.", TRUE, "jane1", "chem");
INSERT INTO Class(name, description, enroll_open, tutor_uname, topic) 
    VALUES ("English 10-1", "High School grade 10 english.", FALSE, "jane1", "engl");

# may have to redo this one after deciding how student_id and class_id are given
# ENROLLED(student_id, class_id, enrollment_date) **Assuming enrollment_date self populates
INSERT INTO Enrolled(student_id, class_id) VALUES (10000, 200);
INSERT INTO Enrolled(student_id, class_id) VALUES (10001, 201);
INSERT INTO Enrolled(student_id, class_id) VALUES (10002, 202);
INSERT INTO Enrolled(student_id, class_id) VALUES (10003, 203);
INSERT INTO Enrolled(student_id, class_id) VALUES (10000, 202);
INSERT INTO Enrolled(student_id, class_id) VALUES (10001, 203);
INSERT INTO Enrolled(student_id, class_id) VALUES (10002, 201);
INSERT INTO Enrolled(student_id, class_id) VALUES (10003, 200);
INSERT INTO Enrolled(student_id, class_id) VALUES (10002, 200);

# LOCATION(location_id, bld_number, street, city, postal_code, building_name) **Assuming location_id self populates
INSERT INTO Location(bld_number, street, city, postal_code, building_name)
    VALUES (410, "University Ct NW", "Calgary", "T2N 1N4", "Taylor Family Digital Library");
INSERT INTO Location(bld_number, street, city, postal_code, building_name)
    VALUES (1530, "Northmount Dr NW", "Calgary", "T2L 0G6", "Nose Hill Libary");

# SCHEDULE_ITEM(schitem_id, start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
# **Assuming schitem_id self populates

## John's closed (filled) mathematics class - 4 sessions on tuesdays in January 2019
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('17:00:00', '18:00:00', '2019-01-08', "john1", FALSE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('17:00:00', '18:00:00', '2019-01-15', "john1", FALSE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('17:00:00', '18:00:00', '2019-01-22', "john1", FALSE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('17:00:00', '18:00:00', '2019-01-29', "john1", FALSE, TRUE);

## John's open physics class - 4 sessions on wednesdays in January 2019
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('18:30:00', '19:30:00', '2019-01-09', "john1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('18:30:00', '19:30:00', '2019-01-16', "john1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('18:30:00', '19:30:00', '2019-01-23', "john1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('18:30:00', '19:30:00', '2019-01-30', "john1", TRUE, TRUE);

## Jane's open Biology Class - 4 sessions on fridays in January 2019
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('16:00:00', '17:00:00', '2019-01-04', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('16:00:00', '17:00:00', '2019-01-11', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('16:00:00', '17:00:00', '2019-01-18', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('16:00:00', '17:00:00', '2019-01-25', "jane1", TRUE, TRUE);

## Jane's open Chemestry Class - 4 sessions on saturdays in January 2019
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('13:00:00', '14:00:00', '2019-01-05', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('13:00:00', '14:00:00', '2019-01-12', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('13:00:00', '14:00:00', '2019-01-19', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('13:00:00', '14:00:00', '2019-01-26', "jane1", TRUE, TRUE);

## Jane's open English Class - 4 sessions on saturdays in January 2019
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('14:30:00', '15:30:00', '2019-01-05', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('14:30:00', '15:30:00', '2019-01-12', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('14:30:00', '15:30:00', '2019-01-19', "jane1", TRUE, TRUE);
INSERT INTO Schedule_item(start_time, end_time, date, tutor_uname, avail_flag, sessitem_flag)
    VALUES ('14:30:00', '15:30:00', '2019-01-26', "jane1", TRUE, TRUE);

# may have to redo this one after deciding how location_id, sched_item_id and class_id are given
# SESSION(class_id, session_num, summary, location_id, sched_item_id)
