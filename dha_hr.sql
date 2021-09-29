/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : dha_hr

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 11/10/2020 14:09:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for acrs
-- ----------------------------
DROP TABLE IF EXISTS `acrs`;
CREATE TABLE `acrs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `period_from` date NULL DEFAULT NULL,
  `period_to` date NULL DEFAULT NULL,
  `appointment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `appointment_date` date NULL DEFAULT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `period_served_io_from` date NULL DEFAULT NULL,
  `period_served_io_to` date NULL DEFAULT NULL,
  `period_served_sro_from` date NULL DEFAULT NULL,
  `period_served_sro_to` date NULL DEFAULT NULL,
  `io_remarks_strong_points` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `io_remarks_weak_area` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `io_remarks_demo_performance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `special_achievements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `io_performance_appraisal_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `io_performance_appraisal_score` int(11) NULL DEFAULT NULL,
  `io_employee_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `io_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `io_appointment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `io_sign_date` date NULL DEFAULT NULL,
  `io_emp_sign_date` date NULL DEFAULT NULL,
  `sro_remarks` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sro_performance_appraisal_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `sro_performance_appraisal_score` int(11) NULL DEFAULT NULL,
  `sro_employee_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `sro_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sro_appointment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sro_sign_date` date NULL DEFAULT NULL,
  `sro_emp_sign_date` date NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `authorized_by` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `authorized_by_date` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `acrs_employee_id_foreign`(`employee_id`) USING BTREE,
  INDEX `acrs_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `acrs_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `acrs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of acrs
-- ----------------------------
INSERT INTO `acrs` VALUES (1, 26, '2001-02-01', '2003-02-01', 'Developer', '2015-01-01', '14', '2003-01-10', '2003-01-11', '2004-02-10', '2004-02-11', 'Strong Points', 'Weak Areas', 'Demo Performance', 'Special Achievements', 4, 5, 0, 'Adolf Gleason', 'Head Accountant', '2005-03-11', '2005-03-10', 'SRO Remarks', 3, 0, 21, 'Waqar Aslam', 'Dep Secy', '2006-04-11', '2006-04-10', 2, NULL, NULL, '2020-09-14 08:05:17', '2020-09-14 08:05:17');
INSERT INTO `acrs` VALUES (2, 26, '2019-01-01', NULL, 'Developer', '2015-01-01', '15', '2019-01-02', '2019-12-30', '2019-01-03', '2019-12-29', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 2, 5, 5, 'Adolf Gleason', 'Head Accountant', '2020-09-13', '2020-09-12', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 1, 10, 21, 'Waqar Aslam', 'Dep Secy', '2020-09-15', '2020-09-14', 2, 18, '2020-09-04', '2020-09-14 08:19:24', '2020-09-16 10:50:27');
INSERT INTO `acrs` VALUES (5, 26, '2020-09-05', NULL, 'Developer', '2015-01-01', '14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2020-09-16 07:03:15', '2020-09-16 07:03:15');
INSERT INTO `acrs` VALUES (6, 26, '2020-09-04', NULL, 'Developer', '2015-01-01', '14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, '2020-09-16 10:07:36', '2020-09-16 10:07:36');

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subject`(`subject_type`, `subject_id`) USING BTREE,
  INDEX `causer`(`causer_type`, `causer_id`) USING BTREE,
  INDEX `activity_log_log_name_index`(`log_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 141 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activity_log
-- ----------------------------
INSERT INTO `activity_log` VALUES (14, 'user', 'updated', 'App\\Models\\User', 20, 'App\\Models\\User', 7, '{\"attributes\":{\"name\":\"Bitfumes\",\"email\":\"gbrekke@example.net\"},\"old\":{\"name\":\"Preston Terry\",\"email\":\"gbrekke@example.net\"}}', '2020-09-25 13:33:33', '2020-09-25 13:33:33');
INSERT INTO `activity_log` VALUES (17, 'user', 'updated', 'App\\Models\\User', 20, 'App\\Models\\User', 7, '{\"attributes\":{\"name\":\"Bitfumes 4\"},\"old\":{\"name\":\"Bitfumes 3\"}}', '2020-09-25 13:43:17', '2020-09-25 13:43:17');
INSERT INTO `activity_log` VALUES (18, 'user', 'created', 'App\\Models\\User', 23, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Mireya Bartell\",\"email\":\"ocrist@example.com\",\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\"}}', '2020-09-28 05:09:38', '2020-09-28 05:09:38');
INSERT INTO `activity_log` VALUES (19, 'user', 'updated', 'App\\Models\\User', 23, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Bitfumes 5\"},\"old\":{\"name\":\"Mireya Bartell\"}}', '2020-09-28 05:12:43', '2020-09-28 05:12:43');
INSERT INTO `activity_log` VALUES (20, 'user', 'updated', 'App\\Models\\User', 23, 'App\\Models\\User', 2, '{\"attributes\":{\"type\":2},\"old\":{\"type\":1}}', '2020-09-28 05:13:27', '2020-09-28 05:13:27');
INSERT INTO `activity_log` VALUES (21, 'user', 'updated', 'App\\Models\\User', 23, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Bitfumes 6\",\"password\":\"Password@1\",\"type\":1,\"club_id\":2},\"old\":{\"name\":\"Bitfumes 5\",\"password\":\"$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC\\/.og\\/at2.uheWG\\/igi\",\"type\":2,\"club_id\":1}}', '2020-09-28 05:25:10', '2020-09-28 05:25:10');
INSERT INTO `activity_log` VALUES (48, 'employee', 'created', 'App\\Models\\Employee', 31, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":31,\"application_id\":null,\"interview_id\":null,\"type_of_contract_id\":2,\"group_id\":2,\"club_id\":1,\"department_id\":1,\"job_type_id\":2,\"name\":\"asdfsadf\",\"employee_number\":\"asdfsadf\",\"cnic\":\"sfsdaf\",\"dob\":null,\"dob_in_words\":null,\"place_of_birth\":null,\"father_name\":null,\"father_profession\":null,\"email\":null,\"gender\":null,\"years_of_experience\":null,\"phone_number\":null,\"photograph\":null,\"appointment\":null,\"appointment_date\":null,\"grade\":null,\"joining_date\":null,\"contract_end_date\":null,\"retirement_date\":null,\"current_salary\":null,\"previous_salary\":null,\"post\":null,\"rank\":null,\"arm\":null,\"last_appointment\":null,\"enrollment_date\":null,\"sos_date\":null,\"sod_date\":null,\"height\":null,\"religion\":null,\"sect\":null,\"caste\":null,\"service_period\":null,\"referee_name\":null,\"referee_address\":null,\"address01\":null,\"street_mohallah\":null,\"city\":null,\"tehsil\":null,\"district\":null,\"post_office\":null,\"police_station\":null,\"railway_station\":null,\"bus_stop\":null,\"folder_name\":null,\"user_id\":2,\"active\":1}}', '2020-09-30 15:28:44', '2020-09-30 15:28:44');
INSERT INTO `activity_log` VALUES (49, 'employee', 'updated', 'App\\Models\\Employee', 31, 'App\\Models\\User', 2, '{\"attributes\":{\"folder_name\":\"31_1601479724_asdfsadf\",\"active\":1},\"old\":{\"folder_name\":null,\"active\":null}}', '2020-09-30 15:28:44', '2020-09-30 15:28:44');
INSERT INTO `activity_log` VALUES (51, 'application', 'updated', 'App\\Models\\Application', 86, 'App\\Models\\User', 2, '{\"attributes\":{\"post\":\"Army Post\",\"enrollment_date\":\"2020-09-29 00:00:00\"},\"old\":{\"post\":null,\"enrollment_date\":null}}', '2020-10-01 10:46:09', '2020-10-01 10:46:09');
INSERT INTO `activity_log` VALUES (52, 'application', 'updated', 'App\\Models\\Application', 86, 'App\\Models\\User', 2, '{\"attributes\":{\"rank\":\"Rank\"},\"old\":{\"rank\":null}}', '2020-10-01 10:46:44', '2020-10-01 10:46:44');
INSERT INTO `activity_log` VALUES (53, 'interview', 'created', 'App\\Models\\Interview', 9, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":9,\"title\":\"Test Interview\",\"job_type_id\":3,\"interview_date\":\"2020-10-02 00:00:00\",\"is_conducted\":null,\"conducted_by\":null,\"user_id\":2}}', '2020-10-01 15:47:19', '2020-10-01 15:47:19');
INSERT INTO `activity_log` VALUES (54, 'interview', 'created', 'App\\Models\\Interview', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":10,\"title\":\"Test Interview\",\"job_type_id\":3,\"interview_date\":\"2020-10-02 00:00:00\",\"is_conducted\":null,\"conducted_by\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (55, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 65, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":65,\"interview_id\":10,\"application_id\":77,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (56, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 66, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":66,\"interview_id\":10,\"application_id\":74,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (57, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 67, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":67,\"interview_id\":10,\"application_id\":72,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (58, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 68, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":68,\"interview_id\":10,\"application_id\":68,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (59, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 69, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":69,\"interview_id\":10,\"application_id\":59,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (60, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 70, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":70,\"interview_id\":10,\"application_id\":54,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (61, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 71, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":71,\"interview_id\":10,\"application_id\":51,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (62, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 72, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":72,\"interview_id\":10,\"application_id\":50,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (63, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 73, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":73,\"interview_id\":10,\"application_id\":47,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (64, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 74, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":74,\"interview_id\":10,\"application_id\":38,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":2}}', '2020-10-01 15:48:47', '2020-10-01 15:48:47');
INSERT INTO `activity_log` VALUES (66, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 65, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (67, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 66, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":1},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (68, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 67, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (69, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 68, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":1},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (70, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 69, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (71, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 70, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (72, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 71, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (73, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 72, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (74, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 73, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (75, 'interviewCandidate', 'updated', 'App\\Models\\InterviewCandidate', 74, 'App\\Models\\User', 2, '{\"attributes\":{\"remarks\":\"Good interview\",\"selected\":0},\"old\":{\"remarks\":null,\"selected\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (76, 'interview', 'updated', 'App\\Models\\Interview', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"is_conducted\":1},\"old\":{\"is_conducted\":null}}', '2020-10-02 05:59:58', '2020-10-02 05:59:58');
INSERT INTO `activity_log` VALUES (77, 'education', 'updated', 'App\\Models\\EducationDetail', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"marks_obtained\":\"849\"},\"old\":{\"marks_obtained\":\"850\"}}', '2020-10-02 15:58:57', '2020-10-02 15:58:57');
INSERT INTO `activity_log` VALUES (78, 'education', 'updated', 'App\\Models\\EducationDetail', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"marks_obtained\":\"850\"},\"old\":{\"marks_obtained\":\"849\"}}', '2020-10-02 16:05:30', '2020-10-02 16:05:30');
INSERT INTO `activity_log` VALUES (79, 'kindered', 'updated', 'App\\Models\\Kindered', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Faiza\"},\"old\":{\"name\":\"Faize\"}}', '2020-10-03 07:37:11', '2020-10-03 07:37:11');
INSERT INTO `activity_log` VALUES (80, 'kindered', 'updated', 'App\\Models\\Kindered', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Faiza Nadeem\"},\"old\":{\"name\":\"Faiza\"}}', '2020-10-03 07:38:10', '2020-10-03 07:38:10');
INSERT INTO `activity_log` VALUES (81, 'kindered', 'updated', 'App\\Models\\Kindered', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"name\":\"Faiza\"},\"old\":{\"name\":\"Faiza Nadeem\"}}', '2020-10-03 07:48:16', '2020-10-03 07:48:16');
INSERT INTO `activity_log` VALUES (83, 'medical', 'updated', 'App\\Models\\Medical', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"appt\":\"Appt here q\"},\"old\":{\"appt\":\"Appt here\"}}', '2020-10-03 10:13:53', '2020-10-03 10:13:53');
INSERT INTO `activity_log` VALUES (84, 'medical', 'created', 'App\\Models\\Medical', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"employee_id\":26,\"club_id\":null,\"department_id\":1,\"title\":\"Test\",\"hospital_name\":\"General Hospital\",\"appt\":\"No APPT\",\"admission_date\":\"2020-10-04\",\"discharge_date\":\"2020-10-05\",\"ion_number\":\"324\",\"ion_date\":\"2020-10-04\",\"attachment\":null,\"score\":10,\"user_id\":2,\"authorized_by\":8}}', '2020-10-03 10:16:13', '2020-10-03 10:16:13');
INSERT INTO `activity_log` VALUES (85, 'conduct', 'updated', 'App\\Models\\EmployeeConduct', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"score\":9},\"old\":{\"score\":10}}', '2020-10-03 10:31:24', '2020-10-03 10:31:24');
INSERT INTO `activity_log` VALUES (86, 'conduct', 'created', 'App\\Models\\EmployeeConduct', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"employee_id\":26,\"title\":\"sadf\",\"score\":3,\"place_of_offence\":\"asdf\",\"date_of_offence\":\"2020-10-01 00:00:00\",\"offence_details\":null,\"punishment\":null,\"punishment_date\":null,\"authority_letter_date\":null,\"authority_letter_image\":null,\"authorized_by\":null,\"user_id\":2}}', '2020-10-03 10:46:01', '2020-10-03 10:46:01');
INSERT INTO `activity_log` VALUES (87, 'conduct', 'updated', 'App\\Models\\EmployeeConduct', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"title\":\"Second Offence\",\"score\":5,\"place_of_offence\":\"Lahore\",\"offence_details\":\"Lorem Ipsum\",\"punishment\":\"Nothing\"},\"old\":{\"title\":\"sadf\",\"score\":3,\"place_of_offence\":\"asdf\",\"offence_details\":null,\"punishment\":null}}', '2020-10-03 10:46:40', '2020-10-03 10:46:40');
INSERT INTO `activity_log` VALUES (88, 'education', 'created', 'App\\Models\\EducationDetail', 23, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":23,\"application_id\":null,\"employee_id\":26,\"title\":\"Matericulation\",\"institute_name\":\"Degree College Lahore\",\"marks_obtained\":\"850\",\"division_grade\":\"A+\",\"year_completed\":\"2010\",\"campus_address\":\"Karachi\",\"attachment\":null,\"file_ext\":null,\"user_id\":\"2\"}}', '2020-10-03 11:00:48', '2020-10-03 11:00:48');
INSERT INTO `activity_log` VALUES (89, 'leave', 'updated', 'App\\Models\\Leave', 54, 'App\\Models\\User', 2, '{\"attributes\":{\"purpose\":\"medical ceretificate\"},\"old\":{\"purpose\":\"medical\"}}', '2020-10-03 13:33:12', '2020-10-03 13:33:12');
INSERT INTO `activity_log` VALUES (90, 'leave', 'updated', 'App\\Models\\Leave', 54, 'App\\Models\\User', 2, '{\"attributes\":{\"purpose\":\"medical certificate\"},\"old\":{\"purpose\":\"medical ceretificate\"}}', '2020-10-03 13:33:21', '2020-10-03 13:33:21');
INSERT INTO `activity_log` VALUES (91, 'medial', 'updated', 'App\\Models\\Medical', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"ion_number\":\"3244\"},\"old\":{\"ion_number\":\"324\"}}', '2020-10-03 13:34:17', '2020-10-03 13:34:17');
INSERT INTO `activity_log` VALUES (92, 'conduct', 'updated', 'App\\Models\\EmployeeConduct', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"offence_details\":\"Lorem Ipsum text\"},\"old\":{\"offence_details\":\"Lorem Ipsum\"}}', '2020-10-03 13:34:53', '2020-10-03 13:34:53');
INSERT INTO `activity_log` VALUES (93, 'education', 'updated', 'App\\Models\\EducationDetail', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"division_grade\":\"B++\"},\"old\":{\"division_grade\":\"A++\"}}', '2020-10-03 13:45:38', '2020-10-03 13:45:38');
INSERT INTO `activity_log` VALUES (94, 'employee', 'updated', 'App\\Models\\Employee', 7, 'App\\Models\\User', 2, '{\"attributes\":{\"folder_name\":\"7_1601735069_alanis_green\"},\"old\":{\"folder_name\":null}}', '2020-10-03 14:24:29', '2020-10-03 14:24:29');
INSERT INTO `activity_log` VALUES (95, 'employee', 'updated', 'App\\Models\\Employee', 7, 'App\\Models\\User', 2, '{\"attributes\":{\"folder_name\":\"7_1601736509_alanis_green\"},\"old\":{\"folder_name\":null}}', '2020-10-03 14:48:29', '2020-10-03 14:48:29');
INSERT INTO `activity_log` VALUES (96, 'medial', 'updated', 'App\\Models\\Medical', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"title\":\"Fever\"},\"old\":{\"title\":\"Fever reported\"}}', '2020-10-05 05:02:09', '2020-10-05 05:02:09');
INSERT INTO `activity_log` VALUES (97, 'medial', 'updated', 'App\\Models\\Medical', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"title\":\"Headache\"},\"old\":{\"title\":\"Fever\"}}', '2020-10-05 05:03:06', '2020-10-05 05:03:06');
INSERT INTO `activity_log` VALUES (98, 'medial', 'updated', 'App\\Models\\Medical', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"title\":\"Headache Updated\"},\"old\":{\"title\":\"Headache\"}}', '2020-10-05 05:03:37', '2020-10-05 05:03:37');
INSERT INTO `activity_log` VALUES (99, 'medial', 'created', 'App\\Models\\Medical', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":3,\"employee_id\":26,\"club_id\":null,\"department_id\":1,\"title\":\"another test\",\"hospital_name\":null,\"appt\":null,\"admission_date\":null,\"discharge_date\":null,\"ion_number\":null,\"ion_date\":null,\"attachment\":null,\"score\":5,\"user_id\":2,\"authorized_by\":null}}', '2020-10-05 05:04:27', '2020-10-05 05:04:27');
INSERT INTO `activity_log` VALUES (100, 'medial', 'created', 'App\\Models\\Medical', 4, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":4,\"employee_id\":26,\"club_id\":null,\"department_id\":1,\"title\":\"Testing\",\"hospital_name\":null,\"appt\":null,\"admission_date\":null,\"discharge_date\":null,\"ion_number\":null,\"ion_date\":null,\"attachment\":null,\"score\":8,\"user_id\":2,\"authorized_by\":null}}', '2020-10-05 05:05:26', '2020-10-05 05:05:26');
INSERT INTO `activity_log` VALUES (101, 'medial', 'updated', 'App\\Models\\Medical', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"title\":\"Test 2\"},\"old\":{\"title\":\"Test\"}}', '2020-10-05 07:22:06', '2020-10-05 07:22:06');
INSERT INTO `activity_log` VALUES (102, 'medial', 'updated', 'App\\Models\\Medical', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"title\":\"Test\"},\"old\":{\"title\":\"Test 2\"}}', '2020-10-05 07:35:57', '2020-10-05 07:35:57');
INSERT INTO `activity_log` VALUES (103, 'employee', 'created', 'App\\Models\\Employee', 32, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":32,\"application_id\":null,\"interview_id\":null,\"type_of_contract_id\":1,\"group_id\":3,\"club_id\":2,\"department_id\":1,\"job_type_id\":1,\"name\":\"Test Employee\",\"employee_number\":\"J-25\",\"cnic\":\"35202356256666\",\"dob\":null,\"dob_in_words\":null,\"place_of_birth\":null,\"father_name\":null,\"father_profession\":null,\"email\":null,\"gender\":null,\"years_of_experience\":null,\"phone_number\":null,\"photograph\":null,\"appointment\":\"Driver\",\"appointment_date\":\"2020-01-01\",\"grade\":\"5\",\"joining_date\":null,\"contract_end_date\":null,\"retirement_date\":null,\"current_salary\":null,\"previous_salary\":null,\"post\":null,\"rank\":null,\"arm\":null,\"last_appointment\":null,\"enrollment_date\":null,\"sos_date\":null,\"sod_date\":null,\"height\":null,\"religion\":null,\"sect\":null,\"caste\":null,\"service_period\":null,\"referee_name\":null,\"referee_address\":null,\"address01\":null,\"street_mohallah\":null,\"city\":null,\"tehsil\":null,\"district\":null,\"post_office\":null,\"police_station\":null,\"railway_station\":null,\"bus_stop\":null,\"folder_name\":null,\"user_id\":2,\"active\":1}}', '2020-10-06 06:07:33', '2020-10-06 06:07:33');
INSERT INTO `activity_log` VALUES (104, 'employee', 'updated', 'App\\Models\\Employee', 32, 'App\\Models\\User', 2, '{\"attributes\":{\"folder_name\":\"32_1601964453_test_employee\",\"active\":1},\"old\":{\"folder_name\":null,\"active\":null}}', '2020-10-06 06:07:33', '2020-10-06 06:07:33');
INSERT INTO `activity_log` VALUES (105, 'education', 'created', 'App\\Models\\EducationDetail', 24, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":24,\"application_id\":68,\"employee_id\":null,\"title\":\"First degree\",\"institute_name\":null,\"marks_obtained\":null,\"division_grade\":null,\"year_completed\":null,\"campus_address\":null,\"attachment\":null,\"file_ext\":null,\"user_id\":\"2\"}}', '2020-10-06 11:04:49', '2020-10-06 11:04:49');
INSERT INTO `activity_log` VALUES (106, 'application', 'updated', 'App\\Models\\Application', 86, 'App\\Models\\User', 3, '{\"attributes\":{\"gender\":\"male\"},\"old\":{\"gender\":null}}', '2020-10-07 04:56:42', '2020-10-07 04:56:42');
INSERT INTO `activity_log` VALUES (107, 'workHistory', 'created', 'App\\Models\\WorkHistory', 12, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":12,\"application_id\":null,\"employee_id\":26,\"job_title\":\"fifth job\",\"company_name\":null,\"company_address\":null,\"start_date\":null,\"end_date\":null,\"attachment\":null,\"file_ext\":null,\"user_id\":\"3\"}}', '2020-10-07 09:33:59', '2020-10-07 09:33:59');
INSERT INTO `activity_log` VALUES (108, 'workHistory', 'updated', 'App\\Models\\WorkHistory', 12, 'App\\Models\\User', 3, '{\"attributes\":{\"company_name\":\"Star Corporation\"},\"old\":{\"company_name\":null}}', '2020-10-07 09:34:34', '2020-10-07 09:34:34');
INSERT INTO `activity_log` VALUES (109, 'interview', 'created', 'App\\Models\\Interview', 11, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":11,\"title\":\"All type of jobs\",\"job_type_id\":0,\"interview_date\":\"2020-10-15 00:00:00\",\"is_conducted\":null,\"conducted_by\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (110, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 75, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":75,\"interview_id\":11,\"application_id\":85,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (111, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 76, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":76,\"interview_id\":11,\"application_id\":84,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (112, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 77, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":77,\"interview_id\":11,\"application_id\":80,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (113, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 78, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":78,\"interview_id\":11,\"application_id\":79,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (114, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 79, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":79,\"interview_id\":11,\"application_id\":74,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (115, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 80, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":80,\"interview_id\":11,\"application_id\":72,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (116, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 81, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":81,\"interview_id\":11,\"application_id\":69,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (117, 'interviewCandidate', 'created', 'App\\Models\\InterviewCandidate', 82, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":82,\"interview_id\":11,\"application_id\":65,\"remarks\":null,\"selected\":null,\"is_employeed\":null,\"user_id\":3}}', '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `activity_log` VALUES (119, 'conduct', 'created', 'App\\Models\\EmployeeConduct', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":3,\"employee_id\":32,\"title\":\"Sed nobis odio ab si\",\"score\":9,\"place_of_offence\":\"Harum a sed est amet\",\"date_of_offence\":\"2008-03-26 00:00:00\",\"offence_details\":\"Facilis velit conseq\",\"punishment\":\"Quibusdam iste sit\",\"punishment_date\":\"1971-01-18\",\"authority_letter_date\":\"2013-06-30\",\"authority_letter_image\":\"1602147789-good and bad way to add into state in redux.jpg\",\"authorized_by\":null,\"user_id\":2}}', '2020-10-08 09:03:09', '2020-10-08 09:03:09');
INSERT INTO `activity_log` VALUES (120, 'conduct', 'created', 'App\\Models\\EmployeeConduct', 4, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":4,\"employee_id\":32,\"title\":\"Sed nobis odio ab si\",\"score\":9,\"place_of_offence\":\"Harum a sed est amet\",\"date_of_offence\":\"2008-03-26 00:00:00\",\"offence_details\":\"Facilis velit conseq\",\"punishment\":\"Quibusdam iste sit\",\"punishment_date\":\"1971-01-18\",\"authority_letter_date\":\"2013-06-30\",\"authority_letter_image\":\"1602147789-good and bad way to add into state in redux.jpg\",\"authorized_by\":null,\"user_id\":2}}', '2020-10-08 09:03:09', '2020-10-08 09:03:09');
INSERT INTO `activity_log` VALUES (121, 'localCourse', 'created', 'App\\Models\\LocalCourse', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":1,\"employee_id\":32,\"title\":\"Non quia laboriosam\",\"date_from\":\"1979-05-25\",\"date_to\":\"1985-10-30\",\"held_at_place\":\"Ipsum mollitia dolo\",\"grade\":\"Nisi quia aperiam au\",\"marks\":\"Nesciunt cillum dol\",\"attachment\":\"1602148331-Opera Snapshot_2019-11-25_000325_fsweb.no.png\",\"authorized_by\":null,\"authorized_by_date\":\"2019-06-27\",\"user_id\":2}}', '2020-10-08 09:12:11', '2020-10-08 09:12:11');
INSERT INTO `activity_log` VALUES (122, 'localCourse', 'updated', 'App\\Models\\LocalCourse', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"grade\":\"A+\",\"marks\":\"352\\/850\"},\"old\":{\"grade\":\"Nisi quia aperiam au\",\"marks\":\"Nesciunt cillum dol\"}}', '2020-10-08 09:46:52', '2020-10-08 09:46:52');
INSERT INTO `activity_log` VALUES (123, 'localCourse', 'updated', 'App\\Models\\LocalCourse', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"marks\":\"360\\/850\"},\"old\":{\"marks\":\"352\\/850\"}}', '2020-10-08 11:02:29', '2020-10-08 11:02:29');
INSERT INTO `activity_log` VALUES (124, 'localCourse', 'created', 'App\\Models\\LocalCourse', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":2,\"employee_id\":32,\"title\":\"Qui est ab impedit\",\"date_from\":\"2009-09-16\",\"date_to\":\"1996-12-13\",\"held_at_place\":\"Quae eum vitae corpo\",\"grade\":\"Explicabo Consectet\",\"marks\":\"500\\/650\",\"attachment\":\"1602155029_huawei-y8p_1.jpg\",\"authorized_by\":5,\"authorized_by_date\":\"1998-01-22\",\"user_id\":2}}', '2020-10-08 11:03:49', '2020-10-08 11:03:49');
INSERT INTO `activity_log` VALUES (125, 'localCourse', 'updated', 'App\\Models\\LocalCourse', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"grade\":\"A++\"},\"old\":{\"grade\":\"Explicabo Consectet\"}}', '2020-10-08 11:08:22', '2020-10-08 11:08:22');
INSERT INTO `activity_log` VALUES (126, 'localCourse', 'updated', 'App\\Models\\LocalCourse', 2, 'App\\Models\\User', 2, '{\"attributes\":{\"grade\":\"++A\"},\"old\":{\"grade\":\"A++\"}}', '2020-10-08 11:08:56', '2020-10-08 11:08:56');
INSERT INTO `activity_log` VALUES (127, 'localCourse', 'created', 'App\\Models\\LocalCourse', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":3,\"employee_id\":32,\"title\":\"Voluptas ut tempora\",\"date_from\":\"2014-07-11\",\"date_to\":\"2012-12-24\",\"held_at_place\":\"Duis iusto sint ut a\",\"grade\":\"Ut dolorum enim quas\",\"marks\":\"Pariatur Facilis co\",\"attachment\":null,\"authorized_by\":null,\"authorized_by_date\":\"2005-08-12\",\"user_id\":2}}', '2020-10-08 11:10:15', '2020-10-08 11:10:15');
INSERT INTO `activity_log` VALUES (128, 'localCourse', 'updated', 'App\\Models\\LocalCourse', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"grade\":\"C\",\"marks\":\"300\\/800\"},\"old\":{\"grade\":\"Ut dolorum enim quas\",\"marks\":\"Pariatur Facilis co\"}}', '2020-10-08 11:10:38', '2020-10-08 11:10:38');
INSERT INTO `activity_log` VALUES (129, 'localCourse', 'updated', 'App\\Models\\LocalCourse', 3, 'App\\Models\\User', 2, '{\"attributes\":{\"authorized_by\":8},\"old\":{\"authorized_by\":null}}', '2020-10-08 11:25:39', '2020-10-08 11:25:39');
INSERT INTO `activity_log` VALUES (130, 'user', 'updated', 'App\\Models\\User', 2, 'App\\Models\\User', 2, '{\"attributes\":[],\"old\":[]}', '2020-10-09 09:33:49', '2020-10-09 09:33:49');
INSERT INTO `activity_log` VALUES (131, 'user', 'created', 'App\\Models\\User', 24, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":24,\"name\":\"Tariq Khan\",\"email\":\"zhowell@bruen.org\",\"email_verified_at\":null,\"password\":\"password\",\"active\":1,\"type\":0,\"club_id\":null,\"created_by\":0,\"employee_id\":null,\"deleted_at\":null}}', '2020-10-10 07:35:05', '2020-10-10 07:35:05');
INSERT INTO `activity_log` VALUES (132, 'user', 'created', 'App\\Models\\User', 25, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":25,\"name\":\"Adolf Gleason\",\"email\":\"deja.hansen@renner.com\",\"email_verified_at\":null,\"password\":\"password\",\"active\":1,\"type\":0,\"club_id\":null,\"created_by\":0,\"employee_id\":null,\"deleted_at\":null}}', '2020-10-10 07:39:46', '2020-10-10 07:39:46');
INSERT INTO `activity_log` VALUES (133, 'user', 'created', 'App\\Models\\User', 26, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":26,\"name\":\"Adolf Gleason\",\"email\":\"deja.hansen@renner.com\",\"email_verified_at\":null,\"password\":\"$2y$10$9RzGSj81mjOW3m7hk1UncuCNEnQTR87avdBYXFpNmTx9Olu6Kjsqy\",\"active\":1,\"type\":0,\"club_id\":null,\"created_by\":0,\"employee_id\":null,\"deleted_at\":null}}', '2020-10-10 07:41:20', '2020-10-10 07:41:20');
INSERT INTO `activity_log` VALUES (134, 'user', 'created', 'App\\Models\\User', 27, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":27,\"name\":\"Adolf Gleason\",\"email\":\"deja.hansen@renner.com\",\"email_verified_at\":null,\"password\":\"$2y$10$8u5fFfjQg42.V3kNdSh3Gub\\/rObL9Fp2vz7KjNVQOtH5MFAVHGHzu\",\"active\":1,\"type\":0,\"club_id\":null,\"created_by\":0,\"employee_id\":null,\"deleted_at\":null}}', '2020-10-10 07:44:53', '2020-10-10 07:44:53');
INSERT INTO `activity_log` VALUES (135, 'user', 'created', 'App\\Models\\User', 24, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":24,\"name\":\"Adolf Gleason\",\"email\":\"deja.hansen@renner.com\",\"email_verified_at\":null,\"password\":\"$2y$10$WOYodmqmp.quOJZ.KDS1jumThno4Sl0D5P5HBpipfidBmj\\/I3m1vW\",\"active\":1,\"type\":4,\"club_id\":2,\"created_by\":2,\"employee_id\":5,\"deleted_at\":null}}', '2020-10-10 07:49:08', '2020-10-10 07:49:08');
INSERT INTO `activity_log` VALUES (136, 'user', 'updated', 'App\\Models\\User', 2, 'App\\Models\\User', 2, '{\"attributes\":[],\"old\":[]}', '2020-10-10 09:08:16', '2020-10-10 09:08:16');
INSERT INTO `activity_log` VALUES (137, 'user', 'created', 'App\\Models\\User', 25, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":25,\"name\":\"Alanis Green\",\"email\":\"qreichel@borer.com\",\"email_verified_at\":null,\"password\":\"$2y$10$mGP59t2idCNNIxGHCRGINuxRRtkVJb0WN86Bh.cPCwwMyg\\/RA50QO\",\"active\":1,\"type\":2,\"club_id\":2,\"created_by\":2,\"employee_id\":7,\"deleted_at\":null}}', '2020-10-10 10:22:58', '2020-10-10 10:22:58');
INSERT INTO `activity_log` VALUES (138, 'user', 'created', 'App\\Models\\User', 26, 'App\\Models\\User', 2, '{\"attributes\":{\"id\":26,\"name\":\"Alanis Green\",\"email\":\"qreichel@borer.com\",\"email_verified_at\":null,\"password\":\"$2y$10$juCZOL.jKTad51sTSLVoG.RR.OCeAhMWbCvFmiL27tKlePxcFHrY6\",\"active\":1,\"type\":1,\"club_id\":2,\"created_by\":2,\"employee_id\":7,\"deleted_at\":null}}', '2020-10-10 10:23:41', '2020-10-10 10:23:41');
INSERT INTO `activity_log` VALUES (139, 'employee', 'updated', 'App\\Models\\Employee', 26, 'App\\Models\\User', 2, '{\"attributes\":{\"group_id\":1,\"employee_number\":\"J-0006\",\"dob\":\"1989-01-08 00:00:00\",\"email\":null,\"phone_number\":\"+92 30 0589-6332\",\"photograph\":null,\"contract_end_date\":null,\"retirement_date\":null},\"old\":{\"group_id\":3,\"employee_number\":\"J-0005\",\"dob\":\"1989-01-08 13:49:24\",\"email\":\"usman@mail.com\",\"phone_number\":\"+923005896332\",\"photograph\":\"1599459178-me.png\",\"contract_end_date\":\"2021-01-01 00:00:00\",\"retirement_date\":\"2030-01-01 00:00:00\"}}', '2020-10-10 14:39:59', '2020-10-10 14:39:59');
INSERT INTO `activity_log` VALUES (140, 'employee', 'updated', 'App\\Models\\Employee', 32, 'App\\Models\\User', 2, '{\"attributes\":{\"group_id\":1,\"phone_number\":\"0300-596-3778\"},\"old\":{\"group_id\":3,\"phone_number\":null}}', '2020-10-10 14:41:25', '2020-10-10 14:41:25');

-- ----------------------------
-- Table structure for applications
-- ----------------------------
DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `father_profession` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `dob` timestamp(0) NULL DEFAULT NULL,
  `dob_in_words` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `years_of_experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `job_type_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `type_of_contract_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_appointment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `enrollment_date` timestamp(0) NULL DEFAULT NULL,
  `sos_date` timestamp(0) NULL DEFAULT NULL,
  `sod_date` timestamp(0) NULL DEFAULT NULL,
  `height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `religion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `caste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `service_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `referee_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `referee_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address01` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `street_mohallah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tehsil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `post_office` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `police_station` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `railway_station` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bus_stop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `short_listed` tinyint(1) NOT NULL DEFAULT 0,
  `is_employeed` tinyint(1) NOT NULL DEFAULT 0,
  `folder_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `club_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `applications_cnic_unique`(`cnic`) USING BTREE,
  INDEX `applications_cnic_name_job_type_id_index`(`cnic`, `name`, `job_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of applications
-- ----------------------------
INSERT INTO `applications` VALUES (1, 'Dr. Joey Conroy', '11111-1111111-1', 'Nicofurt', 'Miss Jermaine Spinka PhD', 'Mechanical Inspector', 'theresia27@parisian.org', 'female', '1997-01-13 10:09:30', 'kq', '6 years', '471-820-3751 x851', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Taryn Wuckert', '37613 Naomi Mission\nElbertland, WA 97251', 'JZ2', 'North Pasquale', 'Lake Kaiaton', 'Karachi', 'Multan', 'Multan', 'Gleichnerville', 'Kovacektown', 'South Adityamouth', 0, 0, NULL, 2, 6, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (2, 'Mrs. Josianne Kohler I', '24234-2342342-3', 'Hassiehaven', 'Mavis Ward Jr.', 'Radio Mechanic', 'bernadine46@hotmail.com', 'female', '1998-04-13 21:01:15', 'OL', '6 years', '1-227-912-1065', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Dr. Cleveland Waters V', '6665 Clemens Corners Suite 299\nKulasland, UT 03693', 'mPh', 'Hamillmouth', 'New Jarret', 'Lahore', 'Lahore', 'Multan', 'Fabianmouth', 'New Cordie', 'Karinaside', 0, 0, NULL, 2, 10, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (3, 'Prof. Gregory Jones', '24234-2342342-4', 'Huelbury', 'Yolanda Schoen V', 'Bindery Worker', 'darrick09@gmail.com', 'male', '1993-09-19 05:15:42', '7ko', '6 years', '+15317429101', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Aditya Hudson V', '4802 Nellie Estates Suite 008\nReingerburgh, DE 73882-4038', 'OF', 'Virgiefort', 'Lake Lorena', 'Lahore', 'Multan', 'Multan', 'Onaport', 'West Brandt', 'West Tatumville', 0, 0, NULL, 2, 11, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (4, 'Santino Mosciski', '24234-2342342-5', 'Port Matildeshire', 'Darrel Keebler', 'Extruding and Drawing Machine Operator', 'padberg.caitlyn@gmail.com', 'male', '1995-11-23 15:56:46', 'l3', '6 years', '(327) 402-7840 x4153', 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Dr. Gisselle Koss', '4366 Jannie Spring Apt. 991\nEast Megane, MD 40097', 'Y4R', 'Bergnaumchester', 'Marvinmouth', 'Lahore', 'Lahore', 'Karachi', 'Lake Krystelmouth', 'Lake Sandrine', 'Parkerberg', 0, 0, NULL, 2, 5, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (5, 'August Fisher', '24234-2342342-6', 'North Justine', 'Bernadette Rutherford', 'Administrative Law Judge', 'ondricka.tristian@gmail.com', 'other', '1973-05-03 02:03:09', 'Uv', '6 years', '646-387-0907', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Theron Howell', '4591 Gorczany Trail Suite 517\nWalterside, IN 65162-7354', 'rVX', 'Port Mathildestad', 'New Kaleigh', 'Karachi', 'Lahore', 'Multan', 'Pfannerstillfurt', 'Port Joanny', 'Batzside', 0, 0, NULL, 2, 11, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (6, 'Mr. Damon Quitzon', '22222-2222222-2', 'Ryanland', 'Ciara Buckridge DDS', 'Lawyer', 'jhayes@fay.net', 'female', '2014-01-03 15:31:55', 'qW', '6 years', '728.708.4841', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Jaiden Heaney', '2437 Jerald Union Suite 536\nMauricioview, MN 52419-7676', '3C', 'New Edytheborough', 'South Lizziechester', 'Multan', 'Multan', 'Karachi', 'North Torranceborough', 'Berneiceborough', 'Faheyview', 0, 0, NULL, 2, 7, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (7, 'Adelbert Beer PhD', 'Awp', 'South Noemi', 'Ms. Aubree Heidenreich', 'Marriage and Family Therapist', 'amari.wisoky@jones.biz', 'other', '2010-03-12 18:49:25', 'xoo', '6 years', '+1-665-753-5392', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Dr. Chester Gaylord', '354 Wilhelm Hill\nLake Billtown, CA 63975-4286', 'Rg', 'Port Brianaberg', 'West Marley', 'Multan', 'Karachi', 'Karachi', 'Lake Anjaliside', 'South Sydneyton', 'Havenside', 0, 0, NULL, 2, 9, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (8, 'Cheyenne Fritsch DVM', 'P9', 'Sauerville', 'Meta Dicki', 'Compacting Machine Operator', 'spencer.aurelio@gmail.com', 'male', '1981-06-15 00:43:46', 'rtQ', '6 years', '647-391-6967', 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Michel Rau', '3983 Schinner Points Apt. 019\nSchinnerstad, NE 32721-8274', 'hTC', 'North Joannie', 'South Rebekaborough', 'Lahore', 'Karachi', 'Karachi', 'Reichertton', 'Port Jovanny', 'North Lonie', 0, 0, NULL, 2, 1, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (9, 'Bulah Mayert', 'QBC', 'West Kasey', 'Dr. Blake Goyette', 'Physical Therapist Assistant', 'erick91@mcglynn.org', 'female', '1980-01-12 18:33:37', 'eTZ', '6 years', '+1 (810) 744-5867', 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Bonita Corwin', '3998 Conroy Plains\nHuelview, MO 85513-9684', '88Q', 'New Leonor', 'North Laura', 'Multan', 'Multan', 'Lahore', 'West Alessandra', 'Lake Leola', 'Port Jimmie', 0, 0, NULL, 2, 8, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (10, 'Mr. Alek Kuphal', '2H', 'Lake Bradlychester', 'Nels Monahan', 'Court Reporter', 'okovacek@reichel.biz', 'other', '1983-01-30 07:18:06', 'FG', '6 years', '1-625-869-4448 x599', 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Dr. Jasper Borer', '72173 Rory Vista\nPort Akeem, MO 37170-8903', 'va', 'West Mauricioton', 'North Evangelinechester', 'Lahore', 'Karachi', 'Multan', 'Mrazshire', 'New Loy', 'Grahamburgh', 0, 0, NULL, 2, 7, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (11, 'Leo Rogahn', 'fp', 'Towneville', 'Moshe Stroman', 'Brattice Builder', 'saige30@hotmail.com', 'female', '1998-01-29 19:23:44', 'ilP', '6 years', '636-467-7829', 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Miss Karina Deckow', '2877 August Ranch\nNew Leopoldoside, MS 85061', 'XW', 'Port Shane', 'South Aldashire', 'Karachi', 'Multan', 'Karachi', 'South Cotyfurt', 'South Marcellaside', 'Stevechester', 0, 0, NULL, 2, 9, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (12, 'Erna Blick I', 'WJ', 'New Chadd', 'Prof. Thomas Parker', 'Safety Engineer', 'reynold.will@yahoo.com', 'female', '2017-04-13 12:47:19', 'tkn', '6 years', '439-915-3746 x6174', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Amiya Labadie', '7735 Haley Road Apt. 543\nBillymouth, OK 77858', 'F2X', 'Wehnerberg', 'Aricshire', 'Karachi', 'Karachi', 'Lahore', 'Lake Jamarview', 'Farrellshire', 'South Henry', 0, 0, NULL, 2, 1, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (13, 'Alexander Hill', 'wS', 'New Princessstad', 'Kiera Cartwright', 'Radiologic Technician', 'jaime91@hotmail.com', 'male', '1983-03-19 06:55:34', 'exw', '6 years', '(225) 285-8155', 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Tyree Walsh', '643 Maude Route Suite 670\nLake Javonhaven, NM 26484-3038', 'AZ', 'Pourosbury', 'Karleyhaven', 'Lahore', 'Multan', 'Multan', 'West Amie', 'Deltafort', 'Doylebury', 0, 0, NULL, 2, 10, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (14, 'Tremaine Ortiz', '2JY', 'Port Myrticebury', 'Ross Marvin', 'Respiratory Therapist', 'elisha.blanda@yahoo.com', 'male', '2013-06-19 07:14:44', 'h9', '6 years', '(741) 629-6917 x85123', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Frederique Lowe', '3791 Grimes Turnpike\nNorth Tomasastad, AR 12648', 'ZdH', 'Murraybury', 'South Willis', 'Karachi', 'Lahore', 'Multan', 'East Tressa', 'Bernardmouth', 'Koelpinside', 0, 0, NULL, 2, 11, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (15, 'Dr. Walton Murray', 'W1M', 'West Rainaton', 'Dr. Carolyne Trantow', 'Hoist and Winch Operator', 'amalia.homenick@yahoo.com', 'other', '1980-01-23 06:50:54', 'BQf', '6 years', '868-899-3797', 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Clare Schuppe V', '52985 Russell Plain\nTressahaven, NV 98801-8287', 'VI7', 'Gleichnerton', 'Boyleton', 'Multan', 'Karachi', 'Karachi', 'Rauburgh', 'Stokesville', 'Kimview', 0, 0, NULL, 2, 6, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (16, 'Lonny Lind', 'ri', 'Maraview', 'Murphy Feil', 'Municipal Court Clerk', 'selena.tromp@jakubowski.com', 'female', '1976-06-25 02:24:10', 'a54', '6 years', '862-478-1839', 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Alysha Bode', '2758 Hermiston Shoal\nLake Sally, NY 98462', 'Vs', 'West Stevie', 'New Ibrahimport', 'Karachi', 'Multan', 'Lahore', 'Gulgowskimouth', 'North Delbertport', 'South Cornell', 0, 0, NULL, 2, 2, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (17, 'Gideon Metz Sr.', 'W2v', 'West Carolina', 'Jazmyn Morar', 'Production Laborer', 'cyril18@ledner.com', 'other', '2010-06-23 21:11:42', 'Q9', '6 years', '1-579-221-0523 x722', 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Dr. Ardella Bauch PhD', '459 Grant Stream\nMaximillianville, VT 37374', 'G9', 'Heleneton', 'East Makennashire', 'Lahore', 'Lahore', 'Karachi', 'Lake Dewitthaven', 'Port Sandraborough', 'Prosaccobury', 0, 0, NULL, 2, 2, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (18, 'Dr. Yasmeen Mraz II', 'ik', 'Port Marcelle', 'Dr. Alfred Emard', 'Motorboat Operator', 'lewis.maggio@gmail.com', 'other', '1983-04-04 03:35:00', 'j6t', '6 years', '401-499-0336 x30144', 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Jovan Lesch', '984 August Cape\nPort Christinamouth, MD 01489', 'NGd', 'New Sylvan', 'East Rhoda', 'Karachi', 'Multan', 'Multan', 'Swiftport', 'Stantonside', 'West Shanna', 0, 0, NULL, 2, 3, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (19, 'Simeon Dickinson', 'IKg', 'Conroyhaven', 'Serena Kihn Jr.', 'Counseling Psychologist', 'hbogisich@hotmail.com', 'female', '1988-08-15 02:47:23', 'WB0', '6 years', '594.935.1275', 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Prof. Zoe O\'Hara', '7068 Christy Circles\nNorth Susan, CA 28670-9116', 'wg', 'East Alveraberg', 'Aylinchester', 'Lahore', 'Multan', 'Karachi', 'East Verniceberg', 'South Olgastad', 'West Robb', 0, 0, NULL, 2, 3, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (20, 'Toni Osinski', '2DL', 'South Madonna', 'Jazmyn Becker', 'Airline Pilot OR Copilot OR Flight Engineer', 'kaleb44@yahoo.com', 'female', '2013-05-31 16:53:54', 'kIK', '6 years', '+1-928-697-1362', 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Earl Fay', '5087 Marge Parkways Apt. 954\nNorth Donbury, OH 90113', 'Yt', 'Farrellshire', 'West Rutheville', 'Multan', 'Lahore', 'Lahore', 'North Reilly', 'Bernardton', 'Imastad', 0, 0, NULL, 2, 1, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (21, 'Prof. Elliott Swift DVM', 'fn5', 'Talonview', 'Ewald Bernhard V', 'Law Enforcement Teacher', 'zulauf.kristopher@murray.com', 'male', '1983-05-10 00:31:27', '82', '6 years', '+1-806-587-6599', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Verner Gerhold', '155 Heidenreich Forest Suite 490\nNew Ashleigh, MD 00117-8363', '3w', 'New Crystel', 'Lake Ebbaside', 'Multan', 'Multan', 'Lahore', 'Florineside', 'East Adrianna', 'Melvinachester', 0, 0, NULL, 2, 1, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (22, 'Josie Ziemann', 'SY6', 'Evaberg', 'Miss Sadye Shields DDS', 'Dentist', 'murazik.trevion@hotmail.com', 'male', '1991-06-15 08:50:08', '2r', '6 years', '1-368-359-7916', 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Deon Ruecker', '73222 Spencer Points\nPort Liliane, RI 32931-3625', 'FWD', 'Port Vidal', 'West Giovannifurt', 'Multan', 'Karachi', 'Multan', 'Lake Daphne', 'Loyalton', 'South Estafurt', 0, 0, NULL, 2, 7, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (23, 'Sage Jenkins', '5E', 'New Green', 'Prof. Julia Rau Jr.', 'Telecommunications Equipment Installer', 'hulda.abernathy@hotmail.com', 'female', '1982-01-24 07:56:49', 'LeB', '6 years', '(424) 247-4455', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Ashlynn Anderson DVM', '31205 Bogisich Drive\nJastberg, MS 65152-6517', '0XR', 'East Cathryn', 'Port Etha', 'Karachi', 'Lahore', 'Multan', 'New Alyceland', 'Stanside', 'Lake Winstonfurt', 0, 0, NULL, 2, 7, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (24, 'Rafaela Kuhic Jr.', 'MG', 'Mayrafort', 'Novella Roob', 'Floral Designer', 'eva30@grant.com', 'other', '1985-03-13 13:35:25', 'h6', '6 years', '742.541.7793 x452', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Mr. Kendrick Rogahn I', '1929 Welch Road Suite 207\nLarsonberg, MA 18022-3111', 'HX8', 'Enashire', 'New Lavernemouth', 'Lahore', 'Multan', 'Karachi', 'Javierfurt', 'New Hanna', 'East Serena', 0, 0, NULL, 2, 3, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (25, 'Terry McLaughlin', 'fYJ', 'Weissnattown', 'Dr. Kristy Littel', 'Textile Machine Operator', 'ezequiel.skiles@crooks.com', 'female', '2006-05-30 22:58:14', 'kLW', '6 years', '(402) 801-4179 x077', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Prof. Sophie Glover', '956 Dusty Parkways\nDenesikburgh, NV 33763', 'zw', 'Enricoborough', 'Hillview', 'Multan', 'Lahore', 'Lahore', 'Lake Connor', 'New Myrtice', 'Port Eltaland', 1, 0, NULL, 2, 9, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (26, 'Heath Kshlerin', '5Z', 'North Ora', 'Boris Mertz', 'Insurance Sales Agent', 'harry45@yahoo.com', 'other', '1991-11-18 20:19:14', '3wy', '6 years', '1-207-477-2194', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Fernando Cremin', '301 Vickie Forest\nBrownfurt, TN 11767-7670', 'FbK', 'Denesikville', 'Gerholdville', 'Lahore', 'Lahore', 'Karachi', 'South Christophe', 'Lake Leviport', 'Gislasonshire', 1, 0, NULL, 2, 10, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (27, 'Neil Rohan V', 'Dw0', 'Kentonport', 'Jaylan Kshlerin Sr.', 'Gas Appliance Repairer', 'kilback.haleigh@hackett.com', 'female', '1993-04-04 20:50:42', 'q0', '6 years', '+1 (331) 988-8094', 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Mr. Bennett Witting', '8371 Lenny Causeway Suite 176\nLelandshire, UT 48007-6596', '9Q', 'Lake Janickhaven', 'West Waylon', 'Lahore', 'Multan', 'Multan', 'East Laurence', 'West Blairberg', 'South Hank', 1, 0, NULL, 2, 3, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (28, 'Celine Strosin Sr.', 'HaT', 'West Fredrickborough', 'Quinn Gutmann', 'Drafter', 'margarita.collier@bailey.org', 'other', '1976-11-26 22:27:40', 'IT', '6 years', '717.419.2681 x2846', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Dr. Eino Waters', '7266 Dibbert Trail\nPort Joey, AL 33631-8328', 'vZ5', 'East Danykamouth', 'Andreaneton', 'Lahore', 'Lahore', 'Lahore', 'Port Mozelleside', 'Reedburgh', 'Port Jameson', 0, 0, NULL, 2, 1, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (29, 'Reina Frami', 'kF', 'Lakinborough', 'Nettie Gorczany', 'Construction Laborer', 'pablo52@murphy.com', 'female', '2008-10-23 17:15:20', 'Zif', '6 years', '+1-995-839-1171', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Dr. Adolphus Heller', '639 Okuneva Grove Suite 449\nFurmanstad, VA 86630-3783', 'fhj', 'Alizaburgh', 'North Trystan', 'Karachi', 'Karachi', 'Lahore', 'North Cayla', 'Schmelerton', 'Jonesville', 0, 0, NULL, 2, 2, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (30, 'Randal Tillman', 'SZt', 'East Marlee', 'Mr. Kaleigh Stiedemann', 'Commercial Diver', 'eula95@schowalter.biz', 'female', '1989-03-07 05:39:59', 'MmE', '6 years', '+1.489.241.7289', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Quinn Padberg II', '24950 DuBuque Lake\nGleasonstad, KY 57058-7471', '7E', 'Earlinebury', 'Rutherfordville', 'Karachi', 'Karachi', 'Lahore', 'North Alek', 'Doylechester', 'New Celia', 0, 0, NULL, 2, 6, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (31, 'Leland Romaguera DDS', 'BD', 'South Eugenia', 'Humberto Tillman', 'Plasterer OR Stucco Mason', 'aryanna12@koelpin.biz', 'female', '1975-04-28 21:20:31', 'ks', '6 years', '(723) 472-9416 x4708', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Juwan O\'Conner Sr.', '774 Cronin Vista\nWest Judge, CA 80203', 'bH', 'Danielside', 'North Arturo', 'Karachi', 'Multan', 'Karachi', 'Bauchmouth', 'Rigobertomouth', 'Mohrton', 0, 0, NULL, 2, 8, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (32, 'Leatha Bailey', 'jjn', 'Filomenachester', 'Wilber Fay', 'Foundry Mold and Coremaker', 'bartell.therese@gmail.com', 'male', '1991-07-12 10:38:19', 'bdF', '6 years', '223.800.9954', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Ed Carroll', '977 Moriah Drives\nAmyshire, DC 25858', '5mh', 'Port Rowanfurt', 'Evelynchester', 'Multan', 'Multan', 'Multan', 'Jalenberg', 'West Sydnee', 'Kiehnport', 0, 0, NULL, 2, 1, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (33, 'Mireille Treutel', 'Pz8', 'Lake Madelynn', 'Connie Bode', 'Painting Machine Operator', 'sbailey@yahoo.com', 'female', '1980-06-10 13:32:32', 'hu', '6 years', '813-518-3680 x603', 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Ms. Arlie Sanford', '4357 Coty Parks\nLouieview, NY 42064', 'Og', 'Huelsland', 'New Giovanishire', 'Multan', 'Karachi', 'Lahore', 'Krisport', 'Wilfredobury', 'Alekview', 0, 0, NULL, 2, 7, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (34, 'Miss Kallie Lesch', 'D2W', 'Whiteland', 'Hillary Schmidt', 'Marketing VP', 'edenesik@zemlak.info', 'other', '2002-09-03 10:29:14', '7J', '6 years', '1-339-346-7724 x99807', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Candelario Mills DVM', '843 Welch Plains Suite 181\nBechtelarberg, WA 20342-9589', 'Fa', 'Alvaside', 'West Gregorio', 'Multan', 'Multan', 'Karachi', 'Abernathyhaven', 'North Jeffrey', 'Harleyside', 0, 0, NULL, 2, 4, '2020-08-31 10:07:29', '2020-08-31 10:07:29');
INSERT INTO `applications` VALUES (36, 'Marlee Goldner', 'gmgPGZp5KI67bkDs', 'West Reyna', 'Lucile Mohr', 'Plumber', 'maynard17@torphy.com', 'male', '1989-12-05 07:38:07', 'CSU', '6 years', '1-709-257-6249', 6, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Mike Adams III', '838 Bertrand Walks Apt. 336\nAdaville, CO 48427-0972', '6J', 'O\'Reillyville', 'Clayport', 'Karachi', 'Lahore', 'Multan', 'North Kelli', 'Port Kassandraview', 'South Alexanderside', 0, 0, NULL, 2, 2, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (37, 'Monte Wolf', 'zskxhjOijdAV0GyS', 'Port Rickhaven', 'Dr. Eduardo Hirthe PhD', 'Gas Pumping Station Operator', 'schultz.molly@wilderman.com', 'female', '2015-08-19 08:05:21', 'Mkt', '6 years', '271.366.1284 x4060', 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Jerome Parisian', '67520 Lenora Tunnel\nKerlukeport, OK 76689-8773', 'Y52', 'South Clemmie', 'Port Florineview', 'Multan', 'Lahore', 'Multan', 'Abagailfort', 'Parisside', 'Darientown', 0, 0, NULL, 2, 10, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (38, 'Terry Kutch', 'BpgnLa2DT5TSFHuk', 'Ludieside', 'Dr. Elijah McKenzie Sr.', 'Bartender Helper', 'francisca04@gmail.com', 'male', '1975-09-19 07:58:05', 'aC3', '6 years', '928.767.9273 x82833', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Keith Hegmann DDS', '945 Madelynn Unions Suite 519\nTanyastad, HI 56833', 'Bze', 'New Shannybury', 'Clareland', 'Karachi', 'Multan', 'Multan', 'Marquesfurt', 'East Clydeberg', 'Jakubowskiport', 0, 0, NULL, 2, 10, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (39, 'Miss Minnie Willms DDS', 'pVYnwT2Vo2DuqwXn', 'North Roel', 'Ed Moen', 'Optical Instrument Assembler', 'margarete.rempel@yahoo.com', 'female', '1986-05-18 14:58:40', 'hI', '6 years', '764-659-5863', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Marisol Kuhn', '95095 Mason Drive\nHintzshire, MI 31848', 'GI', 'Leannonview', 'Langoshstad', 'Lahore', 'Karachi', 'Multan', 'Bradlymouth', 'Mohammedburgh', 'Schuylermouth', 0, 0, NULL, 2, 10, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (40, 'Bert Bartoletti III', 'rShgsvbrlWKuCwdw', 'Bernhardtown', 'Miss Rhea Hammes', 'Social Service Specialists', 'mueller.cary@gmail.com', 'male', '2013-12-10 03:12:59', 'OoD', '6 years', '(629) 918-6665 x57122', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Elenor Rosenbaum', '347 Charley Land\nJanfort, OK 41416-6436', 'l0I', 'Ebonymouth', 'Port Ameliaview', 'Karachi', 'Multan', 'Lahore', 'South Burdette', 'Legrosberg', 'Rohanland', 0, 0, NULL, 2, 8, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (41, 'Samara Bogisich DVM', 'YAZH0LJO4rWhl4Zs', 'New Braulio', 'Deborah Kling', 'Law Enforcement Teacher', 'bailey.pinkie@trantow.info', 'female', '1975-02-09 21:27:11', 'NAy', '6 years', '330.299.7690 x312', 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Dr. Sheldon McCullough', '7748 Francis Loaf Apt. 595\nEast Patrick, MO 18015-3596', 'F2h', 'Dickinsonhaven', 'Daphnehaven', 'Lahore', 'Lahore', 'Multan', 'Lake Virginiaport', 'South Allene', 'Spencerhaven', 0, 0, NULL, 2, 10, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (42, 'Donavon Jaskolski', '8xWGLwdJtQrSahTS', 'Hicklemouth', 'Dr. Khalid Parisian', 'License Clerk', 'hane.brandy@hotmail.com', 'female', '2016-01-10 21:56:03', 'etl', '6 years', '516.853.2317', 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Olaf Tillman', '281 Annamarie Mountains Suite 863\nHermanmouth, GA 19249-2956', '1A', 'Townefurt', 'New Roger', 'Karachi', 'Lahore', 'Multan', 'North Zula', 'East Kobefurt', 'Lindgrenland', 0, 0, NULL, 2, 7, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (43, 'Miss Deja Balistreri', 'ZeCY8a39IW2s4i4N', 'South Petra', 'Effie Bernier', 'Podiatrist', 'leffler.emerald@lang.org', 'other', '2013-10-10 11:16:00', 'fA4', '6 years', '1-953-353-9919', 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Wellington Medhurst', '459 Joaquin Estates Apt. 861\nLake Noelia, CA 17078-2579', 'WTo', 'New Kamron', 'South Vallie', 'Karachi', 'Lahore', 'Multan', 'Trantowchester', 'Nataliechester', 'West Cristianshire', 0, 0, NULL, 2, 6, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (44, 'Marielle Heathcote Sr.', 'OjltC3VqLsz7mQbQ', 'Lake Yesenia', 'Garnet Moore III', 'Forest Fire Fighting Supervisor', 'stark.edmond@connelly.info', 'male', '2018-05-17 18:05:21', 'Miy', '6 years', '425-637-9589 x88193', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Alford Walsh', '45144 Balistreri Prairie Suite 589\nTristianstad, LA 04261-6113', '5R3', 'Lake Brycenton', 'West Kari', 'Multan', 'Multan', 'Karachi', 'Gerdaberg', 'New Briana', 'New Erickland', 0, 0, NULL, 2, 4, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (45, 'Madisyn Kuhlman', 'dn9TbFyzW5A3XySk', 'Trompton', 'Clifton Conroy', 'Occupational Therapist Aide', 'amara.schinner@gmail.com', 'female', '2019-12-18 23:22:10', 'xBT', '6 years', '381.951.9889 x783', 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Jalyn Rowe Sr.', '62958 Osinski Hill Apt. 955\nSouth Malcolm, OH 38425', 'E5', 'Maximilianshire', 'Herzogmouth', 'Karachi', 'Multan', 'Karachi', 'East Milliefort', 'Raphaelleside', 'New Daxmouth', 0, 0, NULL, 2, 11, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (46, 'Dr. Vivien Rippin PhD', 'MaZ3V8Oq8eIhqi1v', 'Wehnershire', 'Libby Ankunding', 'Gas Appliance Repairer', 'tillman.vivianne@feest.com', 'other', '2005-03-13 04:17:04', '6X', '6 years', '417-648-4577', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Elsie O\'Kon', '12389 Madeline Run Suite 697\nSmithamside, DC 13967', '6Q2', 'Lake Roscoe', 'Pearlville', 'Karachi', 'Lahore', 'Lahore', 'Wardton', 'New Alan', 'Anafurt', 0, 0, NULL, 2, 3, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (47, 'Wilfred Roob', 'Cg0lpGPVOPak3PFR', 'Haneville', 'Dr. Kristy Ward MD', 'Health Specialties Teacher', 'ilene.dibbert@turcotte.com', 'male', '1993-07-08 21:48:22', 'Vd', '6 years', '395.486.2950 x09064', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Maye Kirlin', '3309 Hill Mount Apt. 022\nLangoshbury, AR 15054-4993', 'OY', 'Port Clemensshire', 'Judahbury', 'Lahore', 'Multan', 'Multan', 'Ferryton', 'North Marlon', 'Pfannerstillmouth', 0, 0, NULL, 2, 3, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (48, 'Prof. Tristin Ebert DVM', 'qExSVCyQLQQKC14j', 'Rosettaside', 'Francisca Lang', 'Chef', 'marley87@kshlerin.com', 'male', '1997-12-28 12:15:43', 'oby', '6 years', '(853) 253-2419 x38285', 5, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Mrs. Delilah Schroeder Sr.', '973 Herzog Shoal Apt. 499\nCheyennehaven, KS 94917', 'vhd', 'Mullerville', 'Kuhicchester', 'Karachi', 'Multan', 'Multan', 'Swiftchester', 'Strosinmouth', 'Howardmouth', 0, 0, NULL, 2, 4, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (49, 'Zita Schiller', '02FeYhk6WwVU9lQ7', 'North Lawson', 'Eleanore Murray', 'Loan Counselor', 'dale.zieme@gmail.com', 'female', '1994-04-10 06:47:14', 'lx', '6 years', '(987) 417-1615 x0369', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Westley Jaskolski', '399 Lydia Cliffs\nEast Earnest, UT 81227', 'brA', 'Reillyborough', 'Paucekchester', 'Lahore', 'Karachi', 'Lahore', 'East Peggieborough', 'South Bruce', 'New Joburgh', 0, 0, NULL, 2, 10, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (50, 'Rachael Ziemann', 'ybN9l8mJH1SuUDc9', 'East Glorialand', 'Ona Senger', 'Educational Psychologist', 'oskiles@yahoo.com', 'male', '1995-05-08 18:47:07', 'BLV', '6 years', '1-918-890-9187 x85407', 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Rosemary McDermott', '63124 Korbin Cliffs Suite 012\nPort Dolly, IA 65919-6765', '20', 'Emardland', 'South Vernice', 'Lahore', 'Karachi', 'Lahore', 'Heaneyhaven', 'North Herbert', 'Boyermouth', 0, 0, NULL, 2, 9, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (51, 'Gladyce Wiza', '50ritBecA1go4xAI', 'North Aniya', 'Delbert Wilkinson', 'Scientific Photographer', 'kovacek.allison@reinger.com', 'female', '2011-10-23 20:34:46', 'br', '6 years', '560.377.5161 x6789', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Petra Waters IV', '252 Mayer Landing\nEast Katherine, WV 86745-7480', 'NW', 'New Quincymouth', 'Prudenceport', 'Lahore', 'Lahore', 'Karachi', 'Bahringerville', 'Lake Tillman', 'South Mateofort', 0, 0, NULL, 2, 4, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (52, 'Tristian Ondricka MD', 'i50w9pgn1k40Piz1', 'New Travisborough', 'Jessyca Flatley MD', 'Railroad Inspector', 'timmy52@keeling.org', 'female', '1989-08-25 07:14:58', 'CnL', '6 years', '+1-974-421-6524', 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Prof. Modesto Goyette Jr.', '273 Hansen Station Apt. 816\nBradtkeview, SD 10932-4841', 'i2V', 'West Garrick', 'Caylaside', 'Lahore', 'Lahore', 'Karachi', 'North Floydton', 'Weimannbury', 'Lake Sylvanburgh', 0, 0, NULL, 2, 6, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (53, 'Heber Kuphal IV', 'muZwYpDkFxqh8DvV', 'Hillshaven', 'Kacey Ankunding', 'Agricultural Worker', 'ward.laila@heaney.net', 'female', '1973-08-25 04:33:52', '3W', '6 years', '(479) 946-1800', 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Dr. Raheem Wunsch III', '505 Precious Islands Apt. 802\nFritschside, AZ 78651-6160', 'TM', 'Port Alexandreport', 'Brekkeside', 'Karachi', 'Lahore', 'Karachi', 'Port Vida', 'West Fletaland', 'Gulgowskistad', 0, 0, NULL, 2, 4, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (54, 'Prof. Ole Hessel II', 'JjF1BKPgPOgw8C1x', 'Margretton', 'Mr. Alford Bergstrom', 'Telephone Station Installer and Repairer', 'dietrich.hazle@gmail.com', 'other', '1998-11-24 12:21:28', 'oCk', '6 years', '(232) 207-4212 x94146', 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Alexandra Robel', '452 Daniel Highway Suite 340\nNew Celestinomouth, UT 03618', 'apZ', 'South Houstonport', 'New Elvistown', 'Multan', 'Lahore', 'Lahore', 'Staceystad', 'East Neilborough', 'Port Arlo', 0, 0, NULL, 2, 4, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (55, 'Dr. Laverne Franecki V', 'ej0QHNEwerLwOYlK', 'Flatleyport', 'Prof. Kaleigh Hermiston III', 'School Bus Driver', 'ymetz@yahoo.com', 'male', '1990-11-27 12:54:42', 'XZ', '6 years', '1-447-752-7046 x1803', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Dr. Esteban Mitchell', '1372 Kole Shoals\nNew Marlene, VT 61155', 'Mc', 'North Jazmyne', 'Heathcotestad', 'Karachi', 'Karachi', 'Karachi', 'Lake Zita', 'Jaydaland', 'Troybury', 0, 0, NULL, 2, 1, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (56, 'Rod Thompson', 'W5BQDmMWHfY76Vnf', 'Port Mylesfort', 'Consuelo Hauck', 'Pharmacist', 'georgianna51@yahoo.com', 'other', '1985-06-10 07:49:06', '7r', '6 years', '715-793-4187 x0513', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Leopoldo Schinner', '81056 Amira Land Suite 460\nWest Alveratown, NM 66375-4912', 'yDT', 'New Majorbury', 'Priceton', 'Karachi', 'Karachi', 'Multan', 'Gladysfurt', 'East Shanelleshire', 'Rollinberg', 0, 0, NULL, 2, 11, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (57, 'Chad Cremin IV', 'hEniXwRJMMNYIwWS', 'Margarettshire', 'Quincy Cummerata', 'Operations Research Analyst', 'marlin.lindgren@kub.com', 'male', '2013-01-03 14:42:16', 'xE', '6 years', '829.924.7580 x351', 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Marcelle Johnston MD', '848 Sierra Mills Apt. 692\nSchroedershire, CO 57844-7918', '5K', 'North Layla', 'East Jed', 'Karachi', 'Lahore', 'Multan', 'South Jaunita', 'Sporerport', 'Port Howell', 0, 0, NULL, 2, 6, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (58, 'Mr. Wilford Ziemann I', 'OgTciQuwcGvuAW43', 'Feeneyborough', 'Jayne Prosacco', 'Weapons Specialists', 'mark06@gmail.com', 'male', '2015-12-24 21:08:57', 'aTr', '6 years', '+1 (689) 448-5841', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Yasmin Carter', '77408 Jaylan Stream\nWest Orrin, UT 07023-2427', 'zJ', 'Hammesfurt', 'New Meganebury', 'Karachi', 'Lahore', 'Lahore', 'Cartwrightside', 'New Libby', 'New Kasandrachester', 0, 0, NULL, 2, 11, '2020-08-31 10:08:28', '2020-08-31 10:08:28');
INSERT INTO `applications` VALUES (59, 'Prof. Fanny Upton', 'vnvvF31noMZ5G9DO', 'Lake Alyson', 'Lee O\'Reilly', 'Patternmaker', 'zhowell@bruen.org', 'male', '1994-04-19 12:08:53', 'tA', '6 years', '+1-979-919-7560', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Dr. Sarina Bartell', '336 Zander Mount Suite 997\nSouth Steveside, DE 22378-2925', 'Sh', 'Kihntown', 'Lake Dorothy', 'Karachi', 'Karachi', 'Karachi', 'O\'Connellmouth', 'Croninbury', 'Port Jaceyfurt', 0, 1, '59_342324342', 2, 4, '2020-08-31 10:08:29', '2020-09-24 05:24:53');
INSERT INTO `applications` VALUES (60, 'Ophelia Schneider Sr.', '1Exmnce60wglqSrS', 'Hirtheborough', 'Kirstin Hills', 'Loan Interviewer', 'jones.robyn@franecki.com', 'male', '1985-05-17 08:16:08', 'np', '6 years', '(809) 456-0250', 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Candelario Price', '1828 Nader Spring Apt. 774\nRobbshire, OH 10730-4266', '90X', 'Kiaraberg', 'East Izaiahside', 'Multan', 'Karachi', 'Lahore', 'VonRuedenside', 'North Dangelostad', 'Dixiemouth', 0, 0, NULL, 2, 1, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (61, 'Prof. Scottie Ledner', 'JYESzbUhvG09FuiV', 'Binsshire', 'Elissa Klein', 'Short Order Cook', 'margarett.mckenzie@senger.com', 'male', '2018-02-27 10:23:33', 'HnQ', '6 years', '(796) 712-2216', 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Angel Dach Jr.', '313 Marvin Burg Apt. 375\nSengerberg, MI 28834', 'EKt', 'Marleychester', 'Celestineburgh', 'Multan', 'Lahore', 'Lahore', 'South Shania', 'Reillyshire', 'East Watsonbury', 0, 0, NULL, 2, 5, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (62, 'Dr. Kathleen Leannon', 'aLBucBUAxCYpcMMe', 'Filomenaborough', 'Wilhelm Conn', 'Marking Machine Operator', 'ernser.major@gmail.com', 'female', '2003-02-21 12:10:20', 'NY', '6 years', '+1-845-968-2947', 6, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Patsy Johns', '759 Rex Loaf\nParisianfort, AR 98606-5141', 'a29', 'Bashirianfort', 'Lake Kaylah', 'Karachi', 'Karachi', 'Lahore', 'Kundeport', 'Port Gregg', 'New Kelli', 0, 0, NULL, 2, 2, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (63, 'Dr. Bailee Dietrich IV', 'aKeF49wiRPVKwV3B', 'Geraldinechester', 'Dr. Vergie Ruecker', 'Online Marketing Analyst', 'dare.elias@mcdermott.biz', 'female', '1984-08-13 12:23:49', 'zQ', '6 years', '904-467-5906', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Esmeralda Beer DDS', '4219 Nolan Square Apt. 727\nSchaeferberg, MS 58291-1284', 'rFr', 'Greenfelderbury', 'East Harold', 'Multan', 'Karachi', 'Multan', 'New Emersonhaven', 'East Trever', 'Port Oswaldoville', 0, 0, NULL, 2, 6, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (64, 'Prof. Gaston Becker I', '27kMXrHNDxi7W1fK', 'South Zakaryfort', 'Oleta Willms', 'Calibration Technician OR Instrumentation Technician', 'donnelly.wilfred@hotmail.com', 'male', '1990-07-23 09:27:11', 'Nnw', '6 years', '847-662-8274 x457', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Dalton Waelchi', '5502 Magdalen Path Suite 151\nBaumbachville, CA 09232', 'dR', 'Mitchellton', 'West Loyal', 'Karachi', 'Multan', 'Multan', 'Martinamouth', 'Ratkeville', 'West Braxton', 0, 0, NULL, 2, 7, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (65, 'Prof. Cecelia Schuster DDS', 'bn63OvuRNHp0Np33', 'Lillianport', 'Terence Krajcik', 'Secondary School Teacher', 'ryder90@gmail.com', 'other', '1998-09-07 11:33:26', 'wQ', '6 years', '+18532558478', 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Marilie Spencer I', '40357 Howell Forks\nIketown, VA 18231', 'bOo', 'New Mackenzieberg', 'Weberstad', 'Multan', 'Multan', 'Karachi', 'Corrinemouth', 'Shaniabury', 'East Tamarafort', 0, 0, NULL, 2, 11, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (66, 'Dr. Zoie O\'Hara', 'Td17rnkpumTIpFpP', 'North Jay', 'Lyda Schneider', 'Immigration Inspector OR Customs Inspector', 'conroy.dessie@buckridge.com', 'other', '1978-08-28 10:19:22', 'CQx', '6 years', '+12139032176', 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Ms. Taya Dietrich', '7781 Janet Creek Apt. 651\nEast Carolside, GA 79555-0212', 'J0', 'Paigeland', 'Braunmouth', 'Karachi', 'Lahore', 'Multan', 'Beckerbury', 'Quitzonfurt', 'Port Jazmin', 0, 1, NULL, 2, 11, '2020-08-31 10:08:29', '2020-09-05 09:20:29');
INSERT INTO `applications` VALUES (67, 'Miss Kavon Schumm I', 'JVms9Xh3kFlh1CD6', 'Nienowmouth', 'Evie Bartell', 'Poet OR Lyricist', 'reichel.brooklyn@murray.com', 'other', '2004-04-11 17:42:10', 'Jd', '6 years', '(973) 361-1453', 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Dr. Gustave Schmitt', '83793 Hazle Meadows Apt. 244\nHeidimouth, IA 50887-8724', 'JRN', 'Framimouth', 'Lake Savannastad', 'Multan', 'Lahore', 'Lahore', 'Dibbertland', 'Dietrichshire', 'Bogantown', 0, 1, NULL, 2, 6, '2020-08-31 10:08:29', '2020-09-07 10:55:37');
INSERT INTO `applications` VALUES (68, 'Linnea Bartoletti', '11111-1111111-2', 'Lake Americobury', 'Selmer Schaefer Sr.', 'Manager of Air Crew', 'esther.schultz@bednar.com', 'male', '1992-03-04 11:56:50', 'bs', '6 years', '939.861.0269 x71148', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Max Roberts III', '9682 Strosin Brooks\nNorth Gudrunville, NY 63909', 'ht9', 'East Orenhaven', 'Lake Trinitymouth', 'Multan', 'Multan', 'Karachi', 'West Jarod', 'Port Gabetown', 'Revatown', 0, 0, NULL, 2, 8, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (69, 'Mrs. Natalie Quitzon', 'hcv8jdzvTKuC6oDy', 'Boyleville', 'Justyn Medhurst Sr.', 'Medical Scientists', 'everette35@gmail.com', 'female', '2002-06-23 15:50:42', 'CjB', '6 years', '732-235-5898 x7768', 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Dr. Martine Roob DDS', '928 Gage Mountain\nThieltown, AR 06094-8141', 'Tx', 'Ritchiemouth', 'Lake Marley', 'Lahore', 'Karachi', 'Lahore', 'Port Sharon', 'Lefflerland', 'North Deondreberg', 0, 0, NULL, 2, 9, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (70, 'Alayna Wilderman', 'QFLPCmoaVR0u3X7s', 'Port Ernieport', 'Marley Spencer V', 'Plant and System Operator', 'grant.idell@hickle.com', 'other', '2018-12-13 12:01:02', 'wUL', '6 years', '(928) 612-8515 x93678', 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Dr. Garth Bode Jr.', '66229 Wilson Meadows\nWest Gussieton, GA 45055-6572', 'hC', 'East Adriel', 'New Colten', 'Karachi', 'Multan', 'Multan', 'North Lela', 'Barrowsfurt', 'Lionelbury', 0, 0, NULL, 2, 10, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (71, 'Melisa McGlynn', 'Fa5os4nvPmWWjZ3a', 'New Emmett', 'Chadd Prosacco', 'Horticultural Worker', 'glen.kozey@yahoo.com', 'other', '2017-01-05 11:23:00', 'BH', '6 years', '(398) 416-4679 x57450', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Lyla Ferry DDS', '645 Hand Forges\nLucymouth, CA 51548', 'RFM', 'Lake Rahulshire', 'Vandervortstad', 'Karachi', 'Karachi', 'Karachi', 'New Aureliofort', 'Shanonton', 'Port Frederickburgh', 0, 1, NULL, 2, 8, '2020-08-31 10:08:29', '2020-09-05 12:01:09');
INSERT INTO `applications` VALUES (72, 'Leonor Reichert', 'chQJmx5fE0ZKIcR4', 'Shermanchester', 'Elmo Lebsack', 'Compacting Machine Operator', 'hadley.quigley@koss.com', 'female', '2009-03-30 22:20:23', 'zG1', '6 years', '(820) 426-7879 x83987', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Laurine Johnson', '37192 Hamill Lane\nSengermouth, CA 17021', 'rPa', 'Manteville', 'Port Lukasstad', 'Multan', 'Lahore', 'Multan', 'Powlowskiport', 'Kadinberg', 'Antoninaport', 0, 0, NULL, 2, 2, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (73, 'Emery Pacocha', 'jTRLrIa94ewrRlxR', 'Lake Boyd', 'Abner Altenwerth', 'Clinical Psychologist', 'fidel.bode@rolfson.com', 'female', '1992-01-23 16:10:13', 'j1x', '6 years', '(395) 372-0502', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Abdullah Reinger', '2456 Arely Mill Suite 376\nCrystalshire, KS 01031-5398', 'n8O', 'Lake Karson', 'East Carmen', 'Karachi', 'Karachi', 'Karachi', 'Juneberg', 'South Sherman', 'New Dagmar', 0, 0, NULL, 2, 1, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (74, 'Wallace Wiza III', 'okbLbmq0YHPJ5sFD', 'North Vaughn', 'Dr. Maynard Shields', 'Industrial Equipment Maintenance', 'mframi@kunze.biz', 'male', '1978-06-03 15:17:18', 'mGP', '6 years', '665.349.5678 x35944', 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Mireille Steuber', '440 Anais Meadows\nNew Thurmanberg, IN 75786-8919', '2U', 'West Karleeshire', 'Lempiport', 'Lahore', 'Multan', 'Lahore', 'West Abnerville', 'Giuseppefurt', 'Mayaview', 0, 0, NULL, 2, 7, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (75, 'Maryam Schiller', 'jbsBdNeq0mROAEhm', 'East Zachariahville', 'Franco Murray', 'Credit Checker', 'barton.rowland@gulgowski.info', 'other', '2003-10-27 04:16:12', 'pV', '6 years', '(632) 850-9520 x774', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Prof. Bonita Hane Sr.', '533 Alysa Square\nAliciamouth, SC 18133', 'Mt', 'Virgieville', 'Port Leonel', 'Multan', 'Karachi', 'Lahore', 'North Johathanfort', 'Port Heather', 'New Fernando', 0, 1, '75_test', 2, 2, '2020-08-31 10:08:29', '2020-09-07 10:51:17');
INSERT INTO `applications` VALUES (76, 'Tyrique Hyatt', 'ZFOFV0W40ibQsxG6', 'Hageneshaven', 'Reid Jaskolski', 'Materials Engineer', 'jackson95@durgan.net', 'female', '1981-03-23 22:43:45', 'DL', '6 years', '745-328-2554 x83240', 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Ephraim Kuvalis', '68601 Herman Way Suite 589\nRogersmouth, DC 27052-8250', 'OzY', 'Prosaccoview', 'Sigridborough', 'Multan', 'Karachi', 'Karachi', 'South Ceciliatown', 'Toyshire', 'New Elise', 0, 0, NULL, 2, 4, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (77, 'Helene Franecki', 'qQeMsZT4ovpS9Omd', 'North Michellefort', 'Marco Flatley', 'Electrical Drafter', 'florine70@bergnaum.net', 'male', '2014-12-14 21:12:57', 'P2Y', '6 years', '462.948.2723', 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Anderson Crona', '1937 Alexander Tunnel\nLake Hardy, WV 66761-2030', 'RhR', 'Hermannberg', 'North Gerard', 'Lahore', 'Multan', 'Lahore', 'West Jazminfort', 'West Callieshire', 'Toreyfort', 0, 1, NULL, 2, 9, '2020-08-31 10:08:29', '2020-09-05 13:14:43');
INSERT INTO `applications` VALUES (78, 'Adolf Gleason', 'sDvHaiq5cyW7l4yc', 'New Carmella', 'Jennie Barton DDS', 'Medical Scientists', 'deja.hansen@renner.com', 'female', '1977-08-24 05:13:41', '24 August 1977', '6 years', '+14592933835', 1, 1, 'Army Post', 'Army Rank', 'Army ARM', 'Army last appointment', '2000-01-01 11:13:49', '2001-01-01 11:13:49', '2002-01-01 11:13:49', '6 feet', 'Islam', 'Shia', 'Aarian', 'Service period', 'Fausto Price PhD', '24360 Swift Greens\nClaudiamouth, IN 19847', 'FD', 'Steuberborough', 'Port Alice', 'Multan', 'Karachi', 'Karachi', 'Lake Golda', 'North Leonora', 'South Noel', 0, 1, '78_ah', 2, 10, '2020-08-31 10:08:29', '2020-09-04 07:20:51');
INSERT INTO `applications` VALUES (79, 'Amos Nicolas', 'vQqQ34lwL1M93mzG', 'Lake Jeanne', 'Betsy Hand', 'Travel Clerk', 'chanel74@yahoo.com', 'male', '1976-06-26 13:08:52', 'Gzq', '6 years', '516-437-8195 x12934', 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Arjun Lockman', '981 Dickens Curve\nErnestchester, OH 62219-9275', 'N4', 'Hauckborough', 'Darrinborough', 'Karachi', 'Multan', 'Multan', 'Beierside', 'Luellaberg', 'West Jayme', 0, 0, NULL, 2, 4, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (80, 'Mrs. Candida Larson', 'vYmlIu2jI8tL9wU8', 'East Letha', 'Frank McLaughlin', 'Installation and Repair Technician', 'solon.streich@yahoo.com', 'male', '1982-04-13 03:25:15', 'Ye', '6 years', '860.854.0210', 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Gujjar', NULL, 'Ms. Maida Strosin', '903 Duane Dam\nDonnellyview, WV 98402-7517', 'hN', 'Port Carmeloburgh', 'Lake Chadrick', 'Multan', 'Multan', 'Lahore', 'North Cade', 'Lowemouth', 'New Martin', 0, 0, NULL, 2, 8, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (81, 'Cecil Veum', 'I71BARhzT0zI7YsU', 'Dickensfort', 'Mr. Westley McLaughlin MD', 'Buffing and Polishing Operator', 'jaylon.morissette@yahoo.com', 'male', '2015-09-08 15:35:13', 'MTT', '6 years', '378.502.7169', 6, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Bertha Berge', '42016 Schiller Locks Suite 500\nSouth Alf, KS 89789', '5MV', 'Zacherytown', 'West Pamela', 'Karachi', 'Karachi', 'Karachi', 'New Ludietown', 'Gislasonmouth', 'Lake Alejandraside', 0, 0, NULL, 2, 10, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (82, 'Alanis Green', 'L9eL3I3beZv3obQX', 'Janemouth', 'Mr. Keanu Lockman DDS', 'Patrol Officer', 'qreichel@borer.com', 'female', '1981-01-30 09:04:12', 'nr', '6 years', '+1-869-369-3428', 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Mr. Porter Jakubowski', '7774 Janessa Drives Apt. 442\nEast Napoleon, DE 66651-5139', 'Ts9', 'Shanahanbury', 'New Izaiah', 'Lahore', 'Multan', 'Karachi', 'West Lempimouth', 'Sherwoodside', 'East Antoinette', 0, 1, NULL, 2, 8, '2020-08-31 10:08:29', '2020-09-05 09:13:00');
INSERT INTO `applications` VALUES (83, 'Adrain Murphy', 'iP2JHWfI39Pn4auH', 'Hattietown', 'Ms. Maurine Armstrong II', 'Manager of Air Crew', 'boyer.dagmar@gmail.com', 'other', '2010-04-23 13:08:29', 'JM', '6 years', '913.421.0372', 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Aarian', NULL, 'Nico Stokes', '302 Runolfsdottir Manors Apt. 292\nNorth Neilburgh, GA 77232', 'kz', 'Wilfridburgh', 'Rogahnchester', 'Multan', 'Lahore', 'Multan', 'Trantowburgh', 'Gottliebmouth', 'New Myrna', 0, 0, NULL, 2, 6, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (84, 'Reba Roberts', '7Xy4cLeYmCfqbuDW', 'Ratkeberg', 'Lauren Daniel', 'Costume Attendant', 'green.dayna@okon.com', 'other', '1985-09-02 17:18:23', 'bR', '6 years', '1-243-981-1571', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Elijah Hamill III', '6788 Tianna Trafficway Suite 584\nPort Dameonmouth, CA 95353-7136', 'fa', 'Goldnermouth', 'West Francesview', 'Multan', 'Lahore', 'Karachi', 'North Rockystad', 'Emiliamouth', 'South Miracleton', 0, 0, '84_342324342', 2, 4, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (85, 'Ms. Cristal Von Jr.', 'UoCaMPCZmKqyFFEJ', 'North Vanessa', 'Lambert Tillman', 'Freight Inspector', 'lhomenick@hotmail.com', 'female', '2015-03-17 20:49:55', 'pFV', '6 years', '+1 (442) 566-8849', 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Niazi', NULL, 'Dr. Cory Wolf Sr.', '4695 Odell Square\nSouth Violet, NY 52263', '4qb', 'Marquardttown', 'Hillhaven', 'Multan', 'Lahore', 'Multan', 'Bessiefort', 'Lutherborough', 'Schinnerville', 0, 0, '85', 2, 8, '2020-08-31 10:08:29', '2020-08-31 10:08:29');
INSERT INTO `applications` VALUES (86, 'Usman Sharif', '123456-3698741-7', NULL, NULL, NULL, NULL, 'male', '1980-01-01 00:00:00', NULL, '5', NULL, NULL, 1, 'Army Post', 'Rank', NULL, NULL, '2020-09-29 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '86_1599219270_usman_sharif', 2, 2, '2020-09-04 11:34:30', '2020-10-07 04:56:42');
INSERT INTO `applications` VALUES (87, 'khundi churri', '456455546454565445', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '87_1599307842_khundi_churri', 2, 2, '2020-09-05 12:10:42', '2020-09-07 10:44:00');

-- ----------------------------
-- Table structure for clubs
-- ----------------------------
DROP TABLE IF EXISTS `clubs`;
CREATE TABLE `clubs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of clubs
-- ----------------------------
INSERT INTO `clubs` VALUES (1, '01', 'K Club', NULL, 1, 1, '2020-08-31 14:42:08', NULL);
INSERT INTO `clubs` VALUES (2, '02', 'J Club', NULL, 1, 1, '2020-08-31 14:42:08', NULL);
INSERT INTO `clubs` VALUES (3, '03', 'R Club', NULL, 1, 1, '2020-08-31 14:42:08', NULL);
INSERT INTO `clubs` VALUES (4, '04', 'X Club', NULL, 1, 1, '2020-08-31 14:42:08', NULL);

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `departments_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (1, 'IT Department', NULL, 1, 1, '2020-08-31 14:44:33', NULL);
INSERT INTO `departments` VALUES (2, 'Sales Department', NULL, 1, 1, '2020-08-31 14:44:33', NULL);
INSERT INTO `departments` VALUES (3, 'Accounts Department', NULL, 1, 1, '2020-08-31 14:44:33', NULL);

-- ----------------------------
-- Table structure for education_details
-- ----------------------------
DROP TABLE IF EXISTS `education_details`;
CREATE TABLE `education_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `marks_obtained` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `division_grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `year_completed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `campus_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_ext` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of education_details
-- ----------------------------
INSERT INTO `education_details` VALUES (1, 85, NULL, 'fa', NULL, NULL, NULL, NULL, NULL, '1598959639-WhatsApp Image 2020-08-31 at 5.54.01 PM (1)-min-min.jpeg', 'jpeg', '2', '2020-09-01 11:27:19', '2020-09-01 11:27:19');
INSERT INTO `education_details` VALUES (2, 85, NULL, 'BA', NULL, NULL, NULL, NULL, NULL, '1598960194-WhatsApp Image 2020-08-31 at 5.54.03 PM-min-min.jpeg', 'jpeg', '2', '2020-09-01 11:36:34', '2020-09-01 11:36:34');
INSERT INTO `education_details` VALUES (3, 85, NULL, 'asdf', NULL, NULL, NULL, NULL, NULL, '1598960532-WhatsApp Image 2020-08-31 at 5.54.01 PM (1)-min-min.jpeg', 'jpeg', '2', '2020-09-01 11:42:12', '2020-09-01 11:42:12');
INSERT INTO `education_details` VALUES (4, 85, NULL, 'frth', NULL, NULL, NULL, NULL, NULL, '1598960623-WhatsApp Image 2020-08-31 at 5.54.02 PM-min-min.jpeg', 'jpeg', '2', '2020-09-01 11:43:43', '2020-09-01 11:43:43');
INSERT INTO `education_details` VALUES (5, 78, 5, 'First education', 'BISC', '650', 'B+', '2010', 'Township Lahore', '1599041730-WhatsApp Image 2020-08-31 at 5.54.03 PM-min-min.jpeg', 'jpeg', '2', '2020-09-02 10:14:17', '2020-10-01 10:36:46');
INSERT INTO `education_details` VALUES (6, NULL, 6, 'BSc', 'Lahore Institute', '850', 'A++', '2020', 'Garden Town', '1599232007-3I5A0638.JPG', 'JPG', '2', '2020-09-04 15:06:47', '2020-09-04 15:06:47');
INSERT INTO `education_details` VALUES (7, 82, 7, 'First edu', NULL, NULL, NULL, NULL, NULL, '1599296458-d.png', 'png', '2', '2020-09-05 09:00:58', '2020-09-05 09:13:00');
INSERT INTO `education_details` VALUES (16, NULL, 29, 'undefined', 'LUMS', '852', NULL, NULL, NULL, '1599477635-3I5A0638.JPG', 'JPG', '2', '2020-09-07 11:20:35', '2020-09-07 11:20:35');
INSERT INTO `education_details` VALUES (17, NULL, 29, 'undefined', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2020-09-07 11:22:48', '2020-09-07 11:22:48');
INSERT INTO `education_details` VALUES (18, NULL, 22, 'First Education', 'LUMS', NULL, NULL, NULL, NULL, '1599479902-3I5A0638.JPG', 'JPG', '2', '2020-09-07 11:51:39', '2020-09-07 11:58:23');
INSERT INTO `education_details` VALUES (20, NULL, 26, 'BSc (Hons)', 'LUMS', '850', 'B++', '2013', 'Lahore', '1599821559-1599733603-medical01.png', 'png', '2', '2020-09-11 10:52:39', '2020-10-03 13:45:38');
INSERT INTO `education_details` VALUES (21, NULL, 26, 'FSc', 'Punjab College', '1010', 'A+++', '2009', 'Canal Road', NULL, NULL, '2', '2020-09-14 05:44:09', '2020-09-14 05:44:09');
INSERT INTO `education_details` VALUES (22, 78, 26, 'Second Education', 'Lahore Institute', '866', 'A++', '010', 'Modal Town Lahore', '1601548904-cpuamd02.jpg', 'jpg', '2', '2020-10-01 10:41:44', '2020-10-01 10:41:44');
INSERT INTO `education_details` VALUES (23, NULL, 26, 'Matericulation', 'Degree College Lahore', '850', 'A+', '2010', 'Karachi', NULL, NULL, '2', '2020-10-03 11:00:48', '2020-10-03 11:00:48');
INSERT INTO `education_details` VALUES (24, 68, NULL, 'First degree', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2020-10-06 11:04:49', '2020-10-06 11:04:49');

-- ----------------------------
-- Table structure for employee_conducts
-- ----------------------------
DROP TABLE IF EXISTS `employee_conducts`;
CREATE TABLE `employee_conducts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NULL DEFAULT NULL,
  `place_of_offence` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_offence` datetime(0) NOT NULL,
  `offence_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `punishment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punishment_date` date NULL DEFAULT NULL,
  `authority_letter_date` date NULL DEFAULT NULL,
  `authority_letter_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `authorized_by` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `employee_conducts_employee_id_foreign`(`employee_id`) USING BTREE,
  INDEX `employee_conducts_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `employee_conducts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `employee_conducts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employee_conducts
-- ----------------------------
INSERT INTO `employee_conducts` VALUES (1, 26, 'Road Rage', 9, 'Ghazi Road', '2002-01-01 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse in molestie felis, non tincidunt dolor. Donec tristique ut ex sit amet egestas. Praesent fermentum, felis et suscipit egestas, nibh quam suscipit lorem, tincidunt ultricies quam eros sed leo. Ut et commodo velit. Sed viverra nunc eu dolor tristique feugiat. Morbi eu elit diam. Vestibulum eleifend ornare dapibus.', '100 push ups', '2003-01-01', NULL, '1599801517-letter.jpg', 21, 2, '2020-09-11 05:18:37', '2020-10-03 10:31:23');
INSERT INTO `employee_conducts` VALUES (2, 30, 'Second Offence', 5, 'Lahore', '2020-10-01 00:00:00', 'Lorem Ipsum text', 'Nothing', NULL, NULL, NULL, NULL, 2, '2020-10-03 10:46:01', '2020-10-03 13:34:53');
INSERT INTO `employee_conducts` VALUES (3, 32, 'Sed nobis odio ab si', 9, 'Harum a sed est amet', '2008-03-26 00:00:00', 'Facilis velit conseq', 'Quibusdam iste sit', '1971-01-18', '2013-06-30', '1602147789-good and bad way to add into state in redux.jpg', NULL, 2, '2020-10-08 09:03:09', '2020-10-08 09:03:09');
INSERT INTO `employee_conducts` VALUES (4, 32, 'Sed nobis odio ab si', 9, 'Harum a sed est amet', '2008-03-26 00:00:00', 'Facilis velit conseq', 'Quibusdam iste sit', '1971-01-18', '2013-06-30', '1602147789-good and bad way to add into state in redux.jpg', NULL, 2, '2020-10-08 09:03:09', '2020-10-08 09:03:09');

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `interview_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `type_of_contract_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `club_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `job_type_id` bigint(20) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cnic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` timestamp(0) NULL DEFAULT NULL,
  `dob_in_words` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `place_of_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `father_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `father_profession` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `years_of_experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photograph` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `appointment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `appointment_date` date NULL DEFAULT NULL,
  `joining_date` date NULL DEFAULT NULL,
  `contract_end_date` datetime(0) NULL DEFAULT NULL,
  `retirement_date` datetime(0) NULL DEFAULT NULL,
  `current_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `previous_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `arm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_appointment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `enrollment_date` timestamp(0) NULL DEFAULT NULL,
  `sos_date` timestamp(0) NULL DEFAULT NULL,
  `sod_date` timestamp(0) NULL DEFAULT NULL,
  `height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `religion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `caste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `service_period` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `referee_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `referee_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address01` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `street_mohallah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tehsil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `post_office` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `police_station` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `railway_station` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bus_stop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `folder_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `employees_cnic_unique`(`cnic`) USING BTREE,
  INDEX `employees_cnic_name_index`(`cnic`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (5, 78, 1, 1, 1, 2, 2, 1, 'Adolf Gleason', 'asdf', 'sDvHaiq5cyW7l4yc', '1977-08-24 00:00:00', '24 August 1977', 'New Carmella', 'Jennie Barton DDS', 'Medical Scientists', 'deja.hansen@renner.com', 'female', '6 years', '0300-596-3778', NULL, '5', 'Head Accountant', NULL, NULL, NULL, NULL, NULL, NULL, 'Army Post', 'Army Rank', 'Army ARM', 'Army last appointment', '2000-01-01 00:00:00', '2001-01-01 00:00:00', '2002-01-01 00:00:00', '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Fausto Price PhD', '24360 Swift GreensClaudiamouth, IN 19847', 'FD', 'Steuberborough', 'Port Alice', 'Multan', 'Karachi', 'Karachi', 'Lake Golda', 'North Leonora', 'South Noel', '78_ah', 2, 1, '2020-09-04 07:20:51', '2020-09-04 07:20:51');
INSERT INTO `employees` VALUES (6, NULL, NULL, 2, 3, 2, 1, 1, 'Noman Khan', 'J52365', 'safd654asd5f46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0300-596-3778', NULL, '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6_1599232007_noman_khan', 2, 1, '2020-09-04 15:06:47', '2020-09-04 15:06:47');
INSERT INTO `employees` VALUES (7, 82, 6, 4, 1, 2, NULL, 2, 'Alanis Green', 'j001k', 'L9eL3I3beZv3obQX', '1981-01-30 00:00:00', 'nr', 'Janemouth', 'Mr. Keanu Lockman DDS', 'Patrol Officer', 'qreichel@borer.com', 'female', '6 years', '0300-596-3778', NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Mr. Porter Jakubowski', '7774 Janessa Drives Apt. 442East Napoleon, DE 66651-5139', 'Ts9', 'Shanahanbury', 'New Izaiah', 'Lahore', 'Multan', 'Karachi', 'West Lempimouth', 'Sherwoodside', 'East Antoinette', '7_1601736509_alanis_green', 2, 1, '2020-09-05 09:13:00', '2020-10-03 14:48:29');
INSERT INTO `employees` VALUES (8, 66, 4, 4, 1, 2, 2, 3, 'Dr. Zoie O\'Hara', 'J-025-36', 'Td17rnkpumTIpFpP', '1978-08-28 00:00:00', 'CQx', 'North Jay', 'Lyda Schneider', 'Immigration Inspector OR Customs Inspector', 'conroy.dessie@buckridge.com', 'other', '6 years', '0300-596-3778', NULL, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Ms. Taya Dietrich', '7781 Janet Creek Apt. 651East Carolside, GA 79555-0212', 'J0', 'Paigeland', 'Braunmouth', 'Karachi', 'Lahore', 'Multan', 'Beckerbury', 'Quitzonfurt', 'Port Jazmin', NULL, 2, 1, '2020-09-05 09:20:29', '2020-09-05 09:20:29');
INSERT INTO `employees` VALUES (18, NULL, NULL, 2, 2, 2, 1, 6, 'Rafaqat', 'JR963', 'sadfasdf432432', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0300-596-3778', NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18_1599301325_rafaqat', 2, 1, '2020-09-05 10:22:05', '2020-09-05 10:22:05');
INSERT INTO `employees` VALUES (21, NULL, NULL, 2, 3, 1, 2, 2, 'Waqar Aslam', 'XWA002', '466464646489', NULL, NULL, NULL, NULL, NULL, 'waqaraslam@mail.com', NULL, NULL, '0300-596-3778', 'pic.jpg', '10', 'Dep Secy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21_1599304798_waqar_aslam', 2, 1, '2020-09-05 11:19:58', '2020-09-05 11:19:58');
INSERT INTO `employees` VALUES (22, 71, 6, 2, 2, 2, NULL, 2, 'Melisa McGlynn', 'gwgwrre', 'Fa5os4nvPmWWjZ3a', '2017-01-05 00:00:00', 'BH', 'New Emmett', 'Chadd Prosacco', 'Horticultural Worker', 'glen.kozey@yahoo.com', 'other', '6 years', '0300-596-3778', NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Gujjar', NULL, 'Lyla Ferry DDS', '645 Hand ForgesLucymouth, CA 51548', 'RFM', 'Lake Rahulshire', 'Vandervortstad', 'Karachi', 'Karachi', 'Karachi', 'New Aureliofort', 'Shanonton', 'Port Frederickburgh', '22_namee', 2, 1, '2020-09-05 12:01:09', '2020-09-05 12:01:09');
INSERT INTO `employees` VALUES (24, 77, 2, 2, 2, 2, 2, 3, 'Helene Franecki', 'JG002', 'qQeMsZT4ovpS9Omd', '2020-12-14 00:00:00', 'Monday, December 14, 2020', 'North Michellefort', 'Marco Flatley', 'Electrical Drafter', 'florine70@bergnaum.net', 'male', '6 years', '0300-596-3778', NULL, '12', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Anderson Crona', '1937 Alexander TunnelLake Hardy, WV 66761-2030', 'RhR', 'Hermannberg', 'North Gerard', 'Lahore', 'Multan', 'Lahore', 'West Jazminfort', 'West Callieshire', 'Toreyfort', NULL, 2, 1, '2020-09-05 13:14:43', '2020-09-05 13:14:43');
INSERT INTO `employees` VALUES (26, NULL, NULL, 3, 1, 2, 1, 6, 'Usman Sharif', 'J-0006', '35202-3562566-2', '1989-01-08 00:00:00', '1st January, 1989', 'Lahore', 'Muhammad Sharif', 'Self employeedd', NULL, 'male', '5 years', '0300-596-3778', NULL, '14', 'Developer', '2015-02-14', '2015-02-28', NULL, NULL, '50000', NULL, 'Army Post', 'Army Rank', 'Army ARM', 'Army last appointment', '2000-01-01 00:00:00', '2001-01-01 00:00:00', '2002-01-01 00:00:00', '6 feet', 'Islam', 'Shia', 'Aarian', NULL, 'Ms. Taya Dietrich', '7781 Janet Creek Apt. 651East Carolside, GA 79555-0212', '221', 'Lake Rahulshire', 'Vandervortstad', 'Karachi', 'Karachi', 'Karachi', 'New Aureliofort', 'Shanonton', 'Port Frederickburgh', '26_1599459178_me', 2, 1, '2020-09-07 06:12:58', '2020-10-10 14:39:59');
INSERT INTO `employees` VALUES (27, 87, 7, 2, 1, NULL, NULL, 6, 'khundi churri', 'fasf', '35202-3562566-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0300-596-3778', NULL, '15', 'Secretary', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '87_1599307842_khundi_churri', 2, 1, '2020-09-07 10:44:00', '2020-09-07 10:44:00');
INSERT INTO `employees` VALUES (30, 59, 2, 3, 3, 1, 1, 3, 'Tariq Khan', 'K156', 'vnvvF31noMZ5G9DO', '1994-04-19 00:00:00', 'tA', 'Lake Alyson', 'Lee O\'Reilly', 'Patternmaker', 'zhowell@bruen.org', 'male', '6 years', '0300-596-3778', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6 feet', 'Islam', 'Sunni', 'Niazi', NULL, 'Dr. Sarina Bartell', '336 Zander Mount Suite 997South Steveside, DE 22378-2925', 'Sh', 'Kihntown', 'Lake Dorothy', 'Karachi', 'Karachi', 'Karachi', 'O\'Connellmouth', 'Croninbury', 'Port Jaceyfurt', '59_342324342', 2, 1, '2020-09-24 05:24:53', '2020-09-24 05:24:53');
INSERT INTO `employees` VALUES (32, NULL, NULL, 1, 1, 2, 1, 1, 'Test Employee', 'J-25', '35202-3562566-6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0300-596-3778', NULL, '5', 'Driver', '2020-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32_1601964453_test_employee', 2, 1, '2020-10-06 06:07:33', '2020-10-10 14:41:25');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `groups_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES (1, 'Group 1', NULL, 1, 1, '2020-08-31 14:45:48', '2020-08-31 14:46:32');
INSERT INTO `groups` VALUES (2, 'Group 2', NULL, 1, 1, '2020-08-31 14:45:48', '2020-08-31 14:46:32');
INSERT INTO `groups` VALUES (3, 'Group 3', NULL, 1, 1, '2020-08-31 14:45:48', '2020-08-31 14:46:32');

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `size` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES (3, NULL, '1600239795-good and bad way to add into state in redux.jpg', NULL, '468312', 2, 'App\\ACR', '2', '2020-09-16 07:03:15', '2020-09-16 07:03:15');
INSERT INTO `images` VALUES (6, 'ACR Application Form', '1600250856-application01.png', NULL, '137287', 6, 'App\\ACR', '2', '2020-09-16 10:07:36', '2020-09-16 10:07:36');
INSERT INTO `images` VALUES (7, 'ACR Application Form', '1600250856-application02.jpg', NULL, '105498', 6, 'App\\ACR', '2', '2020-09-16 10:07:36', '2020-09-16 10:07:36');
INSERT INTO `images` VALUES (8, 'ACR Application Form', '1600251026-medical01.png', NULL, '57094', 6, 'App\\ACR', '2', '2020-09-16 10:10:26', '2020-09-16 10:10:26');

-- ----------------------------
-- Table structure for interview_candidates
-- ----------------------------
DROP TABLE IF EXISTS `interview_candidates`;
CREATE TABLE `interview_candidates`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `interview_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `selected` tinyint(1) NULL DEFAULT NULL,
  `is_employeed` tinyint(1) NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `interview_candidates_interview_id_foreign`(`interview_id`) USING BTREE,
  INDEX `interview_candidates_application_id_foreign`(`application_id`) USING BTREE,
  INDEX `interview_candidates_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `interview_candidates_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `interview_candidates_interview_id_foreign` FOREIGN KEY (`interview_id`) REFERENCES `interviews` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `interview_candidates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of interview_candidates
-- ----------------------------
INSERT INTO `interview_candidates` VALUES (1, 1, 78, 'Selected', 1, 1, 2, '2020-08-31 10:20:55', '2020-09-04 07:20:51');
INSERT INTO `interview_candidates` VALUES (2, 1, 75, 'Good interview, however not decided yet', 2, NULL, 2, '2020-08-31 10:20:55', '2020-08-31 10:24:49');
INSERT INTO `interview_candidates` VALUES (3, 1, 63, 'Good interview', 0, NULL, 2, '2020-08-31 10:20:55', '2020-08-31 10:24:49');
INSERT INTO `interview_candidates` VALUES (4, 1, 56, 'Good interview', 0, NULL, 2, '2020-08-31 10:20:55', '2020-08-31 10:24:49');
INSERT INTO `interview_candidates` VALUES (5, 1, 46, 'Good interview', 0, NULL, 2, '2020-08-31 10:20:55', '2020-08-31 10:24:49');
INSERT INTO `interview_candidates` VALUES (6, 1, 21, 'Good interview', 0, NULL, 2, '2020-08-31 10:20:55', '2020-08-31 10:24:49');
INSERT INTO `interview_candidates` VALUES (7, 1, 17, 'Good interview', 0, NULL, 2, '2020-08-31 10:20:55', '2020-08-31 10:24:49');
INSERT INTO `interview_candidates` VALUES (8, 2, 77, 'Good interview', 1, 1, 2, '2020-08-31 10:54:39', '2020-09-05 13:14:43');
INSERT INTO `interview_candidates` VALUES (9, 2, 74, 'Good interview', 0, NULL, 2, '2020-08-31 10:54:39', '2020-08-31 10:54:58');
INSERT INTO `interview_candidates` VALUES (10, 2, 72, 'Good interview', 0, NULL, 2, '2020-08-31 10:54:39', '2020-08-31 10:54:58');
INSERT INTO `interview_candidates` VALUES (11, 2, 68, 'Good interview', 0, NULL, 2, '2020-08-31 10:54:39', '2020-08-31 10:54:58');
INSERT INTO `interview_candidates` VALUES (12, 2, 59, 'Good interview', 1, 1, 2, '2020-08-31 10:54:39', '2020-09-24 05:24:53');
INSERT INTO `interview_candidates` VALUES (13, 2, 54, 'Good interview', 0, NULL, 2, '2020-08-31 10:54:39', '2020-08-31 10:54:58');
INSERT INTO `interview_candidates` VALUES (14, 2, 51, 'Good interview', 0, NULL, 2, '2020-08-31 10:54:39', '2020-08-31 10:54:58');
INSERT INTO `interview_candidates` VALUES (15, 2, 50, 'Good interview', 0, NULL, 2, '2020-08-31 10:54:39', '2020-08-31 10:54:58');
INSERT INTO `interview_candidates` VALUES (16, 3, 78, 'Good interview', 0, NULL, 2, '2020-09-01 11:11:08', '2020-09-01 11:12:04');
INSERT INTO `interview_candidates` VALUES (17, 3, 75, 'Good interview', 1, 1, 2, '2020-09-01 11:11:08', '2020-09-07 10:51:17');
INSERT INTO `interview_candidates` VALUES (18, 3, 63, 'Good interview', 0, NULL, 2, '2020-09-01 11:11:08', '2020-09-01 11:12:04');
INSERT INTO `interview_candidates` VALUES (19, 3, 56, 'Good interview', 0, NULL, 2, '2020-09-01 11:11:08', '2020-09-01 11:12:04');
INSERT INTO `interview_candidates` VALUES (20, 3, 46, 'Good interview', 0, NULL, 2, '2020-09-01 11:11:08', '2020-09-01 11:12:04');
INSERT INTO `interview_candidates` VALUES (21, 3, 21, 'Good interview', 0, NULL, 2, '2020-09-01 11:11:08', '2020-09-01 11:12:04');
INSERT INTO `interview_candidates` VALUES (22, 3, 17, 'Good interview', 0, NULL, 2, '2020-09-01 11:11:08', '2020-09-01 11:12:04');
INSERT INTO `interview_candidates` VALUES (23, 4, 85, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (24, 4, 84, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (25, 4, 82, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (26, 4, 71, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (27, 4, 66, 'Good interview', 1, 1, 2, '2020-09-02 04:28:53', '2020-09-05 09:20:29');
INSERT INTO `interview_candidates` VALUES (28, 4, 58, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (29, 4, 55, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (30, 4, 43, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (31, 4, 41, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (32, 4, 26, 'Good interview', 0, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:30:20');
INSERT INTO `interview_candidates` VALUES (33, 5, 81, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (34, 5, 76, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (35, 5, 70, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (36, 5, 67, 'Good interview', 1, 1, 2, '2020-09-02 04:33:15', '2020-09-07 10:55:37');
INSERT INTO `interview_candidates` VALUES (37, 5, 62, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (38, 5, 60, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (39, 5, 45, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (40, 5, 42, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (41, 5, 40, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (42, 5, 36, 'Good interview', 0, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:36:39');
INSERT INTO `interview_candidates` VALUES (43, 6, 84, 'Good interview', 1, NULL, 2, '2020-09-02 12:34:29', '2020-09-02 12:35:52');
INSERT INTO `interview_candidates` VALUES (44, 6, 82, 'Good interview', 1, 1, 2, '2020-09-02 12:34:29', '2020-09-05 09:13:00');
INSERT INTO `interview_candidates` VALUES (45, 6, 71, 'Good interview', 1, 1, 2, '2020-09-02 12:34:29', '2020-09-05 12:01:09');
INSERT INTO `interview_candidates` VALUES (46, 6, 66, 'Good interview', 0, NULL, 2, '2020-09-02 12:34:29', '2020-09-02 12:35:52');
INSERT INTO `interview_candidates` VALUES (47, 7, 87, 'Good interview', 1, 1, 2, '2020-09-05 12:11:44', '2020-09-07 10:44:00');
INSERT INTO `interview_candidates` VALUES (48, 7, 86, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (49, 7, 78, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (50, 7, 75, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (51, 7, 63, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (52, 7, 56, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (53, 7, 46, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (54, 7, 21, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (55, 7, 17, 'Good interview', 0, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:59');
INSERT INTO `interview_candidates` VALUES (56, 8, 87, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (57, 8, 86, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (58, 8, 78, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (59, 8, 75, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (60, 8, 63, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (61, 8, 56, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (62, 8, 46, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (63, 8, 21, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (64, 8, 17, NULL, NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interview_candidates` VALUES (65, 10, 77, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:57');
INSERT INTO `interview_candidates` VALUES (66, 10, 74, 'Good interview', 1, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (67, 10, 72, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (68, 10, 68, 'Good interview', 1, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (69, 10, 59, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (70, 10, 54, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (71, 10, 51, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (72, 10, 50, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (73, 10, 47, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (74, 10, 38, 'Good interview', 0, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interview_candidates` VALUES (75, 11, 85, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `interview_candidates` VALUES (76, 11, 84, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `interview_candidates` VALUES (77, 11, 80, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `interview_candidates` VALUES (78, 11, 79, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `interview_candidates` VALUES (79, 11, 74, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `interview_candidates` VALUES (80, 11, 72, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `interview_candidates` VALUES (81, 11, 69, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');
INSERT INTO `interview_candidates` VALUES (82, 11, 65, NULL, NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');

-- ----------------------------
-- Table structure for interviews
-- ----------------------------
DROP TABLE IF EXISTS `interviews`;
CREATE TABLE `interviews`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `interview_date` timestamp(0) NULL DEFAULT NULL,
  `is_conducted` tinyint(1) NULL DEFAULT NULL,
  `conducted_by` bigint(20) NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `interviews_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `interviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of interviews
-- ----------------------------
INSERT INTO `interviews` VALUES (1, 'Driver first batch', 1, '2020-09-01 00:00:00', 1, NULL, 2, '2020-08-31 10:20:55', '2020-08-31 10:20:55');
INSERT INTO `interviews` VALUES (2, 'Gurad first interview', 3, '2021-01-01 00:00:00', NULL, NULL, 2, '2020-08-31 10:54:39', '2020-08-31 10:54:39');
INSERT INTO `interviews` VALUES (3, 'Third interview', 1, '2021-01-01 00:00:00', NULL, NULL, 2, '2020-09-01 11:11:08', '2020-09-01 11:11:08');
INSERT INTO `interviews` VALUES (4, 'Waiter interview', 2, '2020-10-01 00:00:00', NULL, NULL, 2, '2020-09-02 04:28:53', '2020-09-02 04:28:53');
INSERT INTO `interviews` VALUES (5, 'HR Cleark Interview', 6, '2020-10-01 00:00:00', NULL, NULL, 2, '2020-09-02 04:33:15', '2020-09-02 04:33:15');
INSERT INTO `interviews` VALUES (6, 'waiters', 2, '2020-09-02 00:00:00', NULL, NULL, 2, '2020-09-02 12:34:29', '2020-09-02 12:34:29');
INSERT INTO `interviews` VALUES (7, 'khundi churri interview', 1, '2021-01-01 00:00:00', NULL, NULL, 2, '2020-09-05 12:11:44', '2020-09-05 12:11:44');
INSERT INTO `interviews` VALUES (8, 'Driver hiring', 1, '2020-09-20 00:00:00', NULL, NULL, 2, '2020-09-19 11:24:52', '2020-09-19 11:24:52');
INSERT INTO `interviews` VALUES (10, 'Test Interview', 3, '2020-10-02 00:00:00', 1, NULL, 2, '2020-10-01 15:48:47', '2020-10-02 05:59:58');
INSERT INTO `interviews` VALUES (11, 'All type of jobs', 0, '2020-10-15 00:00:00', NULL, NULL, 3, '2020-10-07 11:51:22', '2020-10-07 11:51:22');

-- ----------------------------
-- Table structure for job_types
-- ----------------------------
DROP TABLE IF EXISTS `job_types`;
CREATE TABLE `job_types`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsibilities` varchar(6000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_types
-- ----------------------------
INSERT INTO `job_types` VALUES (1, 'Driver', NULL, '1', '2020-08-31 14:47:01', NULL);
INSERT INTO `job_types` VALUES (2, 'Waiter', NULL, '1', '2020-08-31 14:47:01', NULL);
INSERT INTO `job_types` VALUES (3, 'Guard', NULL, '1', '2020-08-31 14:47:01', NULL);
INSERT INTO `job_types` VALUES (4, 'Sweeper', NULL, '1', '2020-08-31 14:47:01', NULL);
INSERT INTO `job_types` VALUES (5, 'Manager', NULL, '1', '2020-08-31 14:47:01', NULL);
INSERT INTO `job_types` VALUES (6, 'HR Cleark', NULL, '1', '2020-08-31 14:47:01', NULL);

-- ----------------------------
-- Table structure for kindereds
-- ----------------------------
DROP TABLE IF EXISTS `kindereds`;
CREATE TABLE `kindereds`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `relationship` enum('wife','mother','father','sons','daughters','brothers','sisters') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NULL DEFAULT NULL,
  `marriage_date` date NULL DEFAULT NULL,
  `next_of_kin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cnic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date_of_entry` date NULL DEFAULT NULL,
  `authorized_by` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kindereds_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `kindereds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kindereds
-- ----------------------------
INSERT INTO `kindereds` VALUES (1, 26, 'wife', 'Noshi', '1992-01-01', '2020-09-01', 'Mother', '352023-3693699-9', '2020-09-16', 5, 2, '2020-09-21 13:57:21', '2020-09-21 13:57:24');
INSERT INTO `kindereds` VALUES (2, 26, 'wife', 'Faiza', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-10-03 07:48:16');
INSERT INTO `kindereds` VALUES (3, 26, 'mother', 'Kauser', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 6, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (4, 26, 'father', 'Pervaiz', '2020-09-02', '2020-09-01', 'Rashid', '3453435345345', '2020-09-03', 7, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (5, 26, 'brothers', 'Hamid', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (6, 26, 'brothers', 'Sajid', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (7, 26, 'sisters', 'Sidra', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (8, 26, 'sisters', 'Shamsa', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (9, 26, 'sons', 'Ali', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (10, 26, 'sons', 'Umer', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (11, 26, 'daughters', 'Sehar', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');
INSERT INTO `kindereds` VALUES (12, 26, 'daughters', 'Fari', '2020-09-02', '2020-09-01', 'Razia', '3453435345345', '2020-09-03', 21, 2, '2020-09-21 11:43:00', '2020-09-21 11:43:00');

-- ----------------------------
-- Table structure for leave_types
-- ----------------------------
DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE `leave_types`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of leave_types
-- ----------------------------
INSERT INTO `leave_types` VALUES (1, 'Casual Leave', NULL, 2, '2020-09-16 16:23:51', '2020-09-16 16:23:51');
INSERT INTO `leave_types` VALUES (2, 'Permanent Leave', NULL, 2, '2020-09-16 16:24:07', '2020-09-16 16:25:22');
INSERT INTO `leave_types` VALUES (3, 'Medical Leave', NULL, 2, '2020-09-16 16:25:18', '2020-09-16 16:25:28');
INSERT INTO `leave_types` VALUES (4, 'Incentive Leave', NULL, 2, '2020-09-16 16:26:12', '2020-09-16 16:26:14');

-- ----------------------------
-- Table structure for leaves
-- ----------------------------
DROP TABLE IF EXISTS `leaves`;
CREATE TABLE `leaves`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `type_of_leave_id` bigint(20) UNSIGNED NOT NULL,
  `from` date NULL DEFAULT NULL,
  `to` date NULL DEFAULT NULL,
  `total_days` int(11) NULL DEFAULT NULL,
  `purpose` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `authorized_by` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `leaves_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of leaves
-- ----------------------------
INSERT INTO `leaves` VALUES (1, 26, 1, '2020-09-02', '2020-09-08', 7, 'Casual leave updated', 21, '1600340738-application-1915347_1280.jpg', 2, '2020-09-17 10:36:31', '2020-09-18 07:20:44');
INSERT INTO `leaves` VALUES (2, 26, 4, '2020-01-01', '2020-01-03', 3, 'Consectetur sed voluptas amet rerum. Quae doloremque maiores saepe omnis omnis libero quod ratione. Adipisci ut doloribus sequi.', 22, NULL, 1, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (3, 26, 1, '2000-02-04', '1983-08-22', 16, 'Et sed ea blanditiis quo quod. Eius porro rem voluptatibus vitae veritatis necessitatibus aut fuga. Officia vel officiis consequatur alias.', 27, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (4, 26, 4, '2015-01-11', '1976-11-30', 1, 'Repellendus nostrum aut facilis magnam. Repudiandae temporibus vel enim consequatur ut. Consequatur dolorem beatae doloribus deleniti saepe vel. Illum asperiores ab ea ut id.', 22, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (5, 26, 3, '1990-04-13', '1971-07-08', 20, 'Assumenda doloremque sed non. Vel optio nihil recusandae non quibusdam. Porro quam et rerum voluptatum. Tempore omnis vel sed explicabo ut.', 5, NULL, 10, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (6, 26, 4, '1983-09-01', '1996-07-05', 2, 'Occaecati amet at similique minima voluptatem sunt quisquam. Quod reiciendis vitae soluta. Eveniet ut quae accusamus qui commodi. Sapiente exercitationem rerum placeat nisi officiis numquam.', 24, NULL, 10, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (7, 26, 3, '2014-01-03', '2014-01-10', 17, 'Illum mollitia ducimus est unde. Quaerat nemo ipsa sit deleniti. Ipsum deleniti doloribus in ducimus.', 18, NULL, 1, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (8, 21, 3, '1985-03-03', '2000-09-17', 13, 'Aperiam saepe consequuntur fugit dolor distinctio. Labore facere et non blanditiis nostrum aperiam et sit. In sequi nam qui sequi aut.', 24, NULL, 8, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (9, 8, 3, '1973-05-13', '1982-10-20', 14, 'Animi repudiandae distinctio dolores doloremque consequuntur nihil. Ab recusandae ut explicabo ratione quaerat. Aut itaque ea aliquid qui. Et aliquam aut eum expedita saepe et.', 7, NULL, 4, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (10, 26, 3, '2011-09-29', '1998-12-29', 19, 'Quod dolores ea consequatur atque. Delectus consequatur accusamus ipsum deleniti dolor tempore enim. Qui recusandae expedita rem similique repellat voluptatem rerum.', 21, NULL, 1, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (11, 26, 3, '2000-07-09', '1971-09-01', 9, 'Aut est consequuntur molestiae nostrum provident hic dolore. Aperiam atque provident iure vel. Molestiae maiores dolore numquam veniam id.', 18, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (12, 26, 2, '1998-04-10', '2003-07-20', 15, 'Laudantium sit distinctio accusamus et vel ipsum vel. Dignissimos mollitia consectetur mollitia provident tempora sed qui et. Ab aut perspiciatis ut corrupti. Necessitatibus tempora cum quis illo distinctio eum optio.', 27, NULL, 4, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (13, 26, 4, '1982-08-19', '2009-02-19', 8, 'Placeat cum deleniti accusantium. Sed excepturi similique ea dolores porro delectus blanditiis. Et et ut id illo. Vel ut numquam dolore possimus illum.', 24, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (14, 26, 4, '2011-11-21', '1990-09-29', 9, 'Deserunt aut ullam sit iste qui. Corrupti non est expedita ullam praesentium velit modi.', 5, NULL, 2, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (15, 26, 3, '2020-05-11', '2020-05-11', 1, 'Odio veritatis tempora sit officiis vel ea enim. Animi iure excepturi voluptatem repudiandae quo. Dolor ullam qui quisquam et et eum nisi. Culpa et non illo ipsa ut deserunt necessitatibus. Et vel voluptatem placeat qui itaque natus laborum.', 18, NULL, 4, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (16, 26, 3, '1996-04-29', '1973-09-20', 6, 'Sunt quis vitae consequuntur eveniet occaecati qui. Sequi labore est itaque eos fugit consequatur velit est. Voluptatibus distinctio architecto voluptatem consequuntur modi doloremque. Cumque reprehenderit cum accusantium quia cum.', 8, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (17, 26, 3, '2019-11-05', '2017-09-18', 5, 'Repellendus eos provident at voluptatum autem voluptatem quis enim. Deleniti ipsam vitae sapiente beatae reiciendis nobis ea quas. Earum sapiente sunt placeat odio voluptatem quasi hic.', 27, NULL, 8, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (18, 26, 2, '2006-04-08', '1994-07-16', 6, 'Quidem illum et sunt optio sapiente blanditiis. Ipsam molestiae facilis illo dolores nesciunt reprehenderit. Consequatur nihil reprehenderit eum quo molestiae est eos. Consequatur velit cumque natus vel.', 26, NULL, 1, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (19, 26, 1, '1971-08-17', '2012-10-17', 10, 'Dicta dolore nam quis vel quidem expedita ratione modi. Et assumenda voluptatem dolorem fugiat suscipit velit. Saepe suscipit qui mollitia qui dignissimos nesciunt.', 27, NULL, 3, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (20, 26, 1, '1994-08-16', '2015-11-17', 19, 'Aliquam voluptatem quo sint molestiae molestias aut. Officiis aspernatur doloremque quo harum. Eligendi cumque atque illum quo consectetur quisquam velit deleniti.', 24, NULL, 6, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (21, 26, 2, '1985-04-06', '2002-07-13', 20, 'Pariatur velit et voluptates sed quia repellat corrupti. Doloremque est voluptates non doloremque. Ut corrupti eveniet qui consectetur sequi ea. Quo maxime consequatur aut quae aut nisi voluptatem.', 8, NULL, 3, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (22, 26, 4, '1992-09-18', '1996-04-03', 6, 'Ab perferendis autem sed ipsam alias pariatur cupiditate. Tenetur veniam commodi maxime iusto quas a. Totam eaque labore consequatur sit laboriosam. Omnis rerum sunt et autem in.', 18, NULL, 4, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (23, 26, 1, '1972-12-17', '1981-02-17', 7, 'Sapiente beatae sapiente dolores. Doloribus minus voluptatem molestiae aut quas non.', 26, NULL, 7, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (24, 26, 3, '2007-12-13', '1977-12-12', 20, 'Dolorum reprehenderit perspiciatis est consequatur est dolore. Reprehenderit tenetur nihil qui voluptatem quis facere nihil. Doloribus id rerum natus quam molestias fugiat. Et iusto officiis voluptate aut molestiae doloribus.', 8, NULL, 6, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (25, 26, 3, '1975-10-28', '1995-01-10', 12, 'Vero et accusantium maxime quos et. In porro dolores soluta necessitatibus. Enim eos sit fugiat. Possimus in rem aliquid autem eos quas.', 27, NULL, 1, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (26, 26, 2, '2011-11-21', '2001-07-04', 9, 'Autem debitis et at atque unde nobis veritatis. Cumque ut ut quasi dolorem hic eos. Ad earum molestias et quam laboriosam.', 6, NULL, 6, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (27, 26, 4, '1984-03-30', '2005-04-05', 2, 'Voluptatem alias in omnis adipisci perferendis. Eos quis quibusdam fugit fugit velit. Suscipit occaecati reiciendis ipsum qui autem qui vero. Veritatis aspernatur sit et numquam minus ea facere rerum. Voluptatibus totam hic ut ipsam rem.', 7, NULL, 11, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (28, 26, 4, '2016-06-22', '1970-03-31', 4, 'Quod fugiat facere corporis quia. Nihil incidunt at laborum non. Natus dolores et est dolore.', 18, NULL, 6, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (29, 26, 3, '2018-07-28', '2005-05-11', 6, 'Officiis dolores odit id nobis incidunt. Aliquam at perferendis neque atque beatae molestias ab. Ut placeat consequatur magni sed autem maiores.', 8, NULL, 8, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (30, 26, 2, '2007-04-25', '1995-10-30', 16, 'Architecto in qui eos eos sit aliquid rem. Voluptas omnis et autem natus quo repellat. Blanditiis dolores et qui.', 26, NULL, 2, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (31, 5, 1, '1999-08-22', '2015-02-18', 9, 'Illum sit blanditiis et ipsum repellendus. Odit nobis non necessitatibus facere ut voluptatem qui distinctio. Molestiae totam neque aliquam dignissimos ipsum qui quia.', 24, NULL, 5, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (32, 7, 2, '1983-11-03', '1985-05-30', 15, 'Expedita fuga aliquid vel corrupti. Iure fugit rerum tempora quibusdam dignissimos qui. Qui placeat nesciunt exercitationem odit voluptatibus voluptas. Ipsam quibusdam ab eligendi sequi.', 21, NULL, 11, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (33, 6, 2, '1979-02-17', '2008-07-27', 20, 'Nihil aut eum sed. Accusantium ipsam molestiae alias deserunt et. Vel error quidem explicabo aut omnis expedita.', 26, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (34, 6, 3, '2017-04-10', '2017-04-06', 3, 'Est recusandae in amet porro cumque dignissimos. Id alias nostrum consequatur enim eum non vitae. Qui et debitis adipisci cum non accusamus necessitatibus. Est earum ullam quo iste expedita quod eveniet.', 6, NULL, 3, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (35, 21, 1, '2019-11-26', '1977-01-19', 9, 'Ducimus mollitia iure accusamus nemo fuga iste ipsam. Sunt ut totam rem ut sed qui. Rerum dicta fuga harum qui adipisci quae distinctio. Exercitationem quisquam quis doloribus nulla illum et.', 27, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (36, 5, 2, '2013-06-02', '1979-12-31', 3, 'Excepturi aut et odio. Sit praesentium similique sequi voluptatem. Dolor molestiae repudiandae itaque. Et qui officiis totam tempore at.', 8, NULL, 2, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (37, 8, 3, '1989-09-29', '2017-06-05', 15, 'Sed aut aut mollitia autem. Hic quos quis culpa amet. Enim eos voluptas laudantium deleniti vitae error.', 24, NULL, 1, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (38, 18, 2, '1998-08-21', '2004-04-28', 16, 'Vero maxime sint voluptas eum consequuntur. Quisquam non esse non aliquam. Quas eum itaque iusto et aliquid in esse.', 18, NULL, 2, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (39, 5, 3, '1978-06-10', '1991-10-13', 8, 'Impedit et enim ut fuga iste. Quia magnam odit nisi odio est. Ratione aperiam quam sunt neque ab nemo voluptatem. Nisi optio alias qui molestiae expedita.', 26, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (40, 18, 1, '1985-10-30', '1971-02-25', 19, 'Et dolorem magnam vel voluptas perferendis odio rem. Officia qui repudiandae dolorum et non sed doloribus est. Autem cupiditate assumenda voluptatum quis.', 5, NULL, 10, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (41, 26, 3, '2001-11-26', '1984-04-29', 10, 'Sed tempore quaerat quisquam provident dolores voluptas autem. Qui non tempora aut eos quia hic pariatur. Sit et praesentium adipisci placeat non veniam temporibus.', 22, NULL, 8, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (42, 18, 2, '2006-02-23', '1984-04-12', 12, 'Impedit consequatur quibusdam repudiandae autem quaerat. Aut voluptatem facilis eligendi nihil quasi cum consectetur sint. Vel praesentium ex dolorem aspernatur dolore qui.', 5, NULL, 1, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (43, 7, 1, '2015-03-25', '1995-05-06', 1, 'Ullam eos quos omnis cupiditate voluptas. Excepturi vel id et blanditiis. Voluptate eius animi dolore consequuntur possimus consectetur.', 7, NULL, 3, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (44, 5, 1, '1979-01-05', '1994-03-14', 16, 'Qui eligendi qui fuga possimus. Id animi quia adipisci provident. Quis dolorem quae qui.', 5, NULL, 3, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (45, 18, 4, '2009-11-10', '1975-03-04', 7, 'Nemo eius similique ullam soluta. Quia et magni voluptatem ratione numquam in. Ad nostrum aut similique.', 26, NULL, 8, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (46, 6, 1, '1983-04-05', '1988-11-16', 8, 'Commodi et ex inventore eum corporis. Id deserunt nostrum quidem explicabo animi quasi. Aliquam dolorem cum autem et beatae eaque. Similique aut quas eligendi quo.', 24, NULL, 5, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (47, 5, 1, '2010-04-14', '2011-08-31', 16, 'Iusto vel doloremque enim quod. Nemo facilis odit dolore sint quia.', 26, NULL, 6, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (48, 27, 4, '1979-08-28', '1994-12-13', 16, 'Neque autem est hic placeat. Voluptatem omnis voluptas magni ea neque. Dignissimos iste ut quia porro.', 27, NULL, 6, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (49, 8, 2, '2008-10-12', '1988-09-09', 13, 'Excepturi saepe asperiores omnis delectus. Itaque ut odit cupiditate dolores aut consequatur. Voluptas doloribus nesciunt quo ducimus itaque. Et consectetur iusto autem qui.', 7, NULL, 9, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (50, 27, 4, '1970-10-03', '1978-05-19', 11, 'Alias odio laudantium alias aut qui porro explicabo. Laboriosam et illo sit culpa. Quam facilis occaecati culpa quidem.', 5, NULL, 11, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (51, 24, 2, '2019-02-07', '2005-01-30', 16, 'Voluptatem commodi animi architecto vero nihil qui. Architecto dicta facere qui rerum.', 7, NULL, 6, '2020-09-17 11:49:21', '2020-09-17 11:49:21');
INSERT INTO `leaves` VALUES (52, 26, 3, '2020-09-03', '2020-09-06', 4, 'Medical Leave', 5, '1600413563-application-1915347_1280.jpg', 2, '2020-09-18 07:19:23', '2020-09-18 07:19:23');
INSERT INTO `leaves` VALUES (53, 26, 4, '2020-09-02', '2020-09-12', 11, 'lorem ipsum', 5, NULL, 2, '2020-09-18 07:23:37', '2020-09-18 07:23:37');
INSERT INTO `leaves` VALUES (54, 26, 3, '2020-09-02', '2020-12-31', 10, 'medical certificate', 21, NULL, 2, '2020-09-18 10:17:53', '2020-10-03 13:33:21');

-- ----------------------------
-- Table structure for local_courses
-- ----------------------------
DROP TABLE IF EXISTS `local_courses`;
CREATE TABLE `local_courses`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_from` date NULL DEFAULT NULL,
  `date_to` date NULL DEFAULT NULL,
  `held_at_place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `marks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `authorized_by` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `authorized_by_date` date NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of local_courses
-- ----------------------------
INSERT INTO `local_courses` VALUES (1, 32, 'Non quia laboriosam', '1979-05-17', '1985-10-30', 'Ipsum mollitia dolo', 'A+', '360/850', '1602148331-Opera Snapshot_2019-11-25_000325_fsweb.no.png', 6, '2019-06-27', 2, '2020-10-08 09:12:11', '2020-10-08 11:02:29');
INSERT INTO `local_courses` VALUES (2, 32, 'Qui est ab impedit', '2009-09-16', '1996-12-13', 'Quae eum vitae corpo', '++A', '500/650', '1602155029_huawei-y8p_1.jpg', 5, '1998-01-22', 2, '2020-10-08 11:03:49', '2020-10-08 11:08:56');
INSERT INTO `local_courses` VALUES (3, 32, 'Voluptas ut tempora', '2014-07-11', '2012-12-24', 'Duis iusto sint ut a', 'C', '300/800', NULL, 8, '2005-08-12', 2, '2020-10-08 11:10:15', '2020-10-08 11:25:39');

-- ----------------------------
-- Table structure for login_histories
-- ----------------------------
DROP TABLE IF EXISTS `login_histories`;
CREATE TABLE `login_histories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `login_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `logout_at` timestamp(0) NULL DEFAULT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `properties` varchar(9000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `login_histories_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `login_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of login_histories
-- ----------------------------
INSERT INTO `login_histories` VALUES (1, 2, '2020-09-28 10:01:52', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (2, 2, '2020-09-28 10:06:44', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (3, 2, '2020-09-28 10:09:51', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (4, 2, '2020-09-28 15:12:48', '2020-09-28 10:12:48', '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (5, 2, '2020-09-28 15:43:11', '2020-09-28 10:43:11', '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (6, 5, '2020-09-28 10:42:54', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (7, 2, '2020-09-30 05:55:26', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (8, 2, '2020-09-30 15:25:42', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (9, 2, '2020-09-30 21:18:50', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (10, 2, '2020-10-02 05:06:50', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (11, 2, '2020-10-03 09:25:08', NULL, '127.0.0.1', NULL);
INSERT INTO `login_histories` VALUES (12, 2, '2020-10-08 05:46:37', NULL, '127.0.0.1', NULL);

-- ----------------------------
-- Table structure for medicals
-- ----------------------------
DROP TABLE IF EXISTS `medicals`;
CREATE TABLE `medicals`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `club_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `appt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `admission_date` date NULL DEFAULT NULL,
  `discharge_date` date NULL DEFAULT NULL,
  `ion_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ion_date` date NULL DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `score` int(11) NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `authorized_by` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `medicals_employee_id_foreign`(`employee_id`) USING BTREE,
  INDEX `medicals_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `medicals_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `medicals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of medicals
-- ----------------------------
INSERT INTO `medicals` VALUES (1, 26, 2, 1, 'Headache Updated', 'Govt Hospital', 'Appt here q', '2001-01-01', '2002-02-02', 'ion-001', '2003-03-03', '1599800789-medical01.png', 5, 2, 7, '2020-09-11 05:06:30', '2020-10-05 05:03:37');
INSERT INTO `medicals` VALUES (2, 26, NULL, 1, 'Test', 'General Hospital', 'No APPT', '2020-10-04', '2020-10-05', '3244', '2020-10-04', NULL, 10, 2, 8, '2020-10-03 10:16:13', '2020-10-05 07:35:57');
INSERT INTO `medicals` VALUES (3, 30, NULL, 1, 'another test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 2, NULL, '2020-10-05 05:04:27', '2020-10-05 05:04:27');
INSERT INTO `medicals` VALUES (4, 26, NULL, 1, 'Testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 2, NULL, '2020-10-05 05:05:26', '2020-10-05 05:05:26');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_08_17_050928_create_type_of_contract_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_08_17_054700_create_groups_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_08_17_055554_create_departments_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_08_17_060029_create_clubs_table', 1);
INSERT INTO `migrations` VALUES (8, '2020_08_17_114742_create_employees_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_08_19_071708_create_applications_table', 1);
INSERT INTO `migrations` VALUES (10, '2020_08_23_003739_create_images_table', 1);
INSERT INTO `migrations` VALUES (11, '2020_08_23_004823_create_education_details_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_08_23_004848_create_work_histories_table', 1);
INSERT INTO `migrations` VALUES (13, '2020_08_23_011312_create_job_types_table', 1);
INSERT INTO `migrations` VALUES (14, '2020_08_29_102849_create_interviews_table', 1);
INSERT INTO `migrations` VALUES (15, '2020_08_29_104544_create_interview_candidates_table', 1);
INSERT INTO `migrations` VALUES (16, '2020_09_03_053105_create_deptartments_table', 2);
INSERT INTO `migrations` VALUES (19, '2020_09_04_105806_create_staff_authorizations_table', 3);
INSERT INTO `migrations` VALUES (26, '2020_09_07_120855_create_employee_conducts_table', 4);
INSERT INTO `migrations` VALUES (27, '2020_09_09_064908_create_medicals_table', 4);
INSERT INTO `migrations` VALUES (29, '2020_09_10_114105_create_acrs_table', 5);
INSERT INTO `migrations` VALUES (30, '2020_09_11_071044_create_performance_appraisals_table', 5);
INSERT INTO `migrations` VALUES (34, '2020_09_15_114334_create_kindereds_table', 6);
INSERT INTO `migrations` VALUES (35, '2020_09_15_121910_create_leaves_table', 6);
INSERT INTO `migrations` VALUES (36, '2020_09_16_111523_create_leave_types_table', 6);
INSERT INTO `migrations` VALUES (37, '2020_09_25_045554_create_activity_log_table', 7);
INSERT INTO `migrations` VALUES (38, '2020_09_28_085748_create_login_histories_table', 8);
INSERT INTO `migrations` VALUES (42, '2020_10_08_071508_create_local_courses_table', 9);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for performance_appraisals
-- ----------------------------
DROP TABLE IF EXISTS `performance_appraisals`;
CREATE TABLE `performance_appraisals`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of performance_appraisals
-- ----------------------------
INSERT INTO `performance_appraisals` VALUES (1, 'Outstanding', 'OS', '10', 1, '2020-09-11 16:47:09', '2020-09-11 16:47:13');
INSERT INTO `performance_appraisals` VALUES (2, 'Above Average', 'AA', '5', 1, '2020-09-11 16:47:09', '2020-09-11 16:47:13');
INSERT INTO `performance_appraisals` VALUES (3, 'Average', 'AVG', '0', 1, '2020-09-11 16:47:09', '2020-09-11 16:47:13');
INSERT INTO `performance_appraisals` VALUES (4, 'Below Average', 'BE', '-5', 1, '2020-09-11 16:47:09', '2020-09-11 16:47:13');

-- ----------------------------
-- Table structure for staff_authorizations
-- ----------------------------
DROP TABLE IF EXISTS `staff_authorizations`;
CREATE TABLE `staff_authorizations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `club_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `max_strength` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `staff_authorizations_club_id_foreign`(`club_id`) USING BTREE,
  INDEX `staff_authorizations_job_type_id_foreign`(`job_type_id`) USING BTREE,
  INDEX `staff_authorizations_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `staff_authorizations_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `staff_authorizations_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `staff_authorizations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of staff_authorizations
-- ----------------------------
INSERT INTO `staff_authorizations` VALUES (1, 1, 1, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (2, 1, 2, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (3, 1, 3, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (4, 1, 4, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (5, 1, 5, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (6, 1, 6, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (8, 2, 1, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (9, 2, 2, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (10, 2, 3, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (11, 2, 4, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (12, 2, 5, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (13, 2, 6, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (14, 3, 1, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (15, 3, 2, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (16, 3, 3, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (17, 3, 4, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (18, 3, 5, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (19, 3, 6, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (20, 4, 1, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (21, 4, 2, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (22, 4, 3, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (23, 4, 4, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (24, 4, 5, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');
INSERT INTO `staff_authorizations` VALUES (25, 4, 6, 2, 2, '2020-09-04 16:05:23', '2020-09-04 16:05:27');

-- ----------------------------
-- Table structure for type_of_contract
-- ----------------------------
DROP TABLE IF EXISTS `type_of_contract`;
CREATE TABLE `type_of_contract`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type_of_contract_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `type_of_contract_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_of_contract
-- ----------------------------
INSERT INTO `type_of_contract` VALUES (1, 'Regular', NULL, 1, 1, '2020-08-31 14:49:18', NULL);
INSERT INTO `type_of_contract` VALUES (2, 'Club Contract', NULL, 1, 1, '2020-08-31 14:49:18', NULL);
INSERT INTO `type_of_contract` VALUES (3, 'Daily Wages Contract', NULL, 1, 1, '2020-08-31 14:49:18', NULL);
INSERT INTO `type_of_contract` VALUES (4, 'DHA Contract', NULL, 1, 1, '2020-08-31 14:49:18', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `type` tinyint(4) NOT NULL,
  `club_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `last_login_at` timestamp(0) NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Dummy', 'dummy@mail.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, NULL, 2, NULL, NULL, 'sVKM52tzHudL8X913By4Bwhq39JXKqrJwMvjPDV0wcnHbS5XtFmy7j15uM2X', NULL, '2020-08-31 14:44:04', '2020-08-31 14:44:08');
INSERT INTO `users` VALUES (2, 'Admin User', 'admin@mail.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 2, 2, 2, NULL, '2020-10-08 05:46:37', 'HWB9qCV7jkPv2hM9KvAN0cKaYUhrsfTiK5lMUgChgPlUkgBRJJrN7Oo4VJfX', NULL, '2020-08-31 09:54:04', '2020-10-08 05:46:37');
INSERT INTO `users` VALUES (3, 'Super Admin', 'super.admin@mail.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 2, 2, 2, NULL, NULL, 'KoNLYWmifP', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (4, 'Director', 'director@mail.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, NULL, 2, NULL, NULL, 'P6WyA2OePM', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (5, 'Normal User', 'user@mail.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 4, 2, 2, NULL, '2020-09-28 10:42:54', 'COAmXhCKW2', NULL, '2020-08-31 09:54:04', '2020-09-28 10:42:54');
INSERT INTO `users` VALUES (6, 'Another User', 'another.user@mail.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 4, NULL, 2, NULL, NULL, 'Y5BT6fLVY3', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (7, 'Major Imran', 'imran@mail.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 3, 2, 2, NULL, NULL, 'NcqnyPHUjI', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (8, 'Mr. Bret Wyman I', 'akilback@example.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 4, 2, 2, NULL, NULL, 'tSMV1aspxp', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (9, 'Braulio Cronin', 'murray.yessenia@example.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 4, 4, 2, NULL, NULL, 'H75XDeCjxY', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (10, 'Lacy Steuber', 'renner.delpha@example.com', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 4, 1, 2, NULL, NULL, 'D1TMs2XHRL', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (11, 'Edwardo Larson', 'ngottlieb@example.org', '2020-08-31 09:54:04', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 4, 2, 2, NULL, NULL, '3jbgjG0hAT', NULL, '2020-08-31 09:54:04', '2020-08-31 09:54:04');
INSERT INTO `users` VALUES (12, 'Larry Greenholt', 'braden.nitzsche@example.org', '2020-09-25 12:31:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 4, 1, 7, NULL, NULL, 'yQiiy9OfHV', NULL, '2020-09-25 12:31:21', '2020-09-25 12:31:21');
INSERT INTO `users` VALUES (13, 'Elizabeth Rau', 'hegmann.jaida@example.net', '2020-09-25 12:32:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 4, 4, 12, NULL, NULL, 'gvuTey5zGn', NULL, '2020-09-25 12:32:24', '2020-09-25 12:32:24');
INSERT INTO `users` VALUES (14, 'Mrs. Rowena O\'Kon', 'schulist.oda@example.org', '2020-09-25 12:36:54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 4, 2, 13, NULL, NULL, 'nhhcKMhXvt', NULL, '2020-09-25 12:36:55', '2020-09-25 12:36:55');
INSERT INTO `users` VALUES (15, 'Myrna Senger', 'bridget.grimes@example.com', '2020-09-25 12:37:21', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 2, 6, NULL, NULL, 'auuAvxGU7l', NULL, '2020-09-25 12:37:21', '2020-09-25 12:37:21');
INSERT INTO `users` VALUES (16, 'Prof. Kody Rowe PhD', 'murazik.grover@example.net', '2020-09-25 12:39:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 4, 9, NULL, NULL, '57aQdIY2BD', NULL, '2020-09-25 12:39:37', '2020-09-25 12:39:37');
INSERT INTO `users` VALUES (17, 'Mike Stehr', 'madaline.rodriguez@example.org', '2020-09-25 12:40:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 2, 4, NULL, NULL, 'teA9nWu8Li', NULL, '2020-09-25 12:40:39', '2020-09-25 12:40:39');
INSERT INTO `users` VALUES (18, 'Mrs. Gracie Cartwright IV', 'mercedes.hand@example.org', '2020-09-25 13:12:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 2, 3, NULL, NULL, 'jmU0fiMnYP', NULL, '2020-09-25 13:12:45', '2020-09-25 13:12:45');
INSERT INTO `users` VALUES (19, 'Ms. Amira Rath', 'jayden38@example.org', '2020-09-25 13:13:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 3, 12, NULL, NULL, '941sVeRDAa', NULL, '2020-09-25 13:13:26', '2020-09-25 13:13:26');
INSERT INTO `users` VALUES (20, 'Bitfumes 4', 'gbrekke@example.net', '2020-09-25 13:15:06', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 4, 11, NULL, NULL, 'DVh5sY3zKv', NULL, '2020-09-25 13:15:06', '2020-09-25 13:43:17');
INSERT INTO `users` VALUES (22, 'Mrs. Alva Auer IV', 'sstrosin@example.net', '2020-09-25 13:42:09', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 3, 17, NULL, NULL, 'sn1NoHzLpz', NULL, '2020-09-25 13:42:09', '2020-09-25 13:42:09');
INSERT INTO `users` VALUES (23, 'Bitfumes 6', 'ocrist@example.com', '2020-09-28 05:09:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1, 2, 22, NULL, NULL, 'vtjSShkoF7', NULL, '2020-09-28 05:09:37', '2020-09-28 05:25:10');
INSERT INTO `users` VALUES (24, 'Adolf Gleason', 'deja.hansen@renner.com', NULL, '$2y$10$WOYodmqmp.quOJZ.KDS1jumThno4Sl0D5P5HBpipfidBmj/I3m1vW', 1, 4, 2, 2, 5, NULL, NULL, NULL, '2020-10-10 07:49:08', '2020-10-10 07:49:08');
INSERT INTO `users` VALUES (26, 'Alanis Green', 'qreichel@borer.com', NULL, '$2y$10$juCZOL.jKTad51sTSLVoG.RR.OCeAhMWbCvFmiL27tKlePxcFHrY6', 1, 1, 2, 2, 7, NULL, NULL, NULL, '2020-10-10 10:23:41', '2020-10-10 10:23:41');

-- ----------------------------
-- Table structure for work_histories
-- ----------------------------
DROP TABLE IF EXISTS `work_histories`;
CREATE TABLE `work_histories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `job_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `company_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `start_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `end_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `file_ext` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of work_histories
-- ----------------------------
INSERT INTO `work_histories` VALUES (1, 78, 5, 'First Job', 'A Company', 'Multan', 'may 2018', 'June 2019', '1599041707-WhatsApp Image 2020-08-31 at 5.54.02 PM-min-min.jpeg', 'jpeg', '2', '2020-09-02 10:15:07', '2020-09-04 07:20:51');
INSERT INTO `work_histories` VALUES (2, 78, 5, 'Second Job', 'Tango Company', 'Lahore', 'June 2019', 'till date', '1599041707-WhatsApp Image 2020-08-31 at 5.54.02 PM-min-min.jpeg', 'jpeg', '2', '2020-09-02 10:15:07', '2020-10-01 10:37:57');
INSERT INTO `work_histories` VALUES (3, NULL, 6, 'First Job', 'HP Computers', 'Somewhere in lahore', '25 march 2019', 'till date', NULL, NULL, '2', '2020-09-04 15:06:47', '2020-09-04 15:06:47');
INSERT INTO `work_histories` VALUES (4, 82, 7, 'First Job updated', 'G45', NULL, NULL, NULL, '1599474383-me.png', 'png', '2', '2020-09-05 09:01:21', '2020-10-03 14:51:29');
INSERT INTO `work_histories` VALUES (5, NULL, 7, 'Second Job', NULL, NULL, NULL, NULL, NULL, NULL, '2', '2020-09-07 10:17:10', '2020-09-07 10:17:10');
INSERT INTO `work_histories` VALUES (6, NULL, 22, 'First Work :D', NULL, NULL, NULL, NULL, '1599480137-WhatsApp Image 2020-08-31 at 5.54.01 PM.jpeg', 'jpeg', '2', '2020-09-07 12:01:23', '2020-09-07 12:02:17');
INSERT INTO `work_histories` VALUES (7, 78, 26, 'Third job', 'Amjad Khan Company', NULL, NULL, NULL, NULL, NULL, '2', '2020-10-01 10:42:33', '2020-10-01 10:42:33');
INSERT INTO `work_histories` VALUES (8, NULL, 26, 'Laravel Developer', 'Laragon Tech', 'Lahore', 'May 2012', 'Jan 2018', '1601654837-huawei-y8p_1.jpg', 'jpg', '2', '2020-10-02 16:06:55', '2020-10-03 13:46:00');
INSERT INTO `work_histories` VALUES (9, NULL, 26, 'Developer TikTok', 'TikTok', 'China', '2010', '2012', '1601723107-cpuamd02.jpg', 'jpg', '2', '2020-10-03 11:04:42', '2020-10-03 11:05:08');
INSERT INTO `work_histories` VALUES (10, NULL, 7, 'Third Job', NULL, NULL, NULL, NULL, NULL, NULL, '2', '2020-10-03 14:51:45', '2020-10-03 14:51:45');
INSERT INTO `work_histories` VALUES (11, 68, 26, 'First Job', NULL, NULL, NULL, NULL, NULL, NULL, '2', '2020-10-06 11:04:57', '2020-10-06 11:04:57');
INSERT INTO `work_histories` VALUES (12, NULL, 26, 'fifth job', 'Star Corporation', NULL, NULL, NULL, NULL, NULL, '3', '2020-10-07 09:33:59', '2020-10-07 09:34:34');

SET FOREIGN_KEY_CHECKS = 1;
