-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 19 ม.ค. 2023 เมื่อ 03:35 PM
-- เวอร์ชันของเซิร์ฟเวอร์: 5.6.51
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp261186_acs-project-prod`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_desc` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_desc`, `created_at`, `updated_at`) VALUES
(1, 'AR', 'ฝ่ายออกแบบสถาปัตยกรรม', '2022-08-10 15:04:19', '2023-01-09 23:46:01'),
(2, 'CM', 'ฝ่ายบริหารและควบคุมงานก่อสร้าง', '2022-08-10 15:04:19', NULL),
(3, 'INFRA', 'ฝ่ายออกแบบวิศวกรรมโยธา', '2022-08-10 15:04:40', NULL),
(4, 'M&E', 'ฝ่ายออกแบบวิศวกรรมงานระบบ', '2022-08-10 15:04:40', NULL),
(5, 'OTHERS', 'อื่นๆ', '2022-08-10 15:05:02', NULL),
(6, 'PM', 'ฝ่ายบริหารโครงการ', '2022-08-10 15:05:02', NULL),
(7, 'R&D', 'ฝ่ายวิจัยและพัฒนา', '2022-08-10 15:05:24', NULL),
(8, 'SD', 'ฝ่ายออกแบบวิศวกรรมโครงสร้าง', '2022-08-10 15:05:24', NULL),
(9, 'CM / SD', 'ฝ่ายบริหารและควบคุมงานก่อสร้าง / ฝ่ายออกแบบวิศวกรรมโครงสร้าง', '2023-01-06 15:32:21', '2023-01-06 15:32:42'),
(10, 'AR / SD / M&E / CM', 'ออกแบบสถาปัตยกรรมและวิศวกรรมโครงสร้าง 	ออกแบบวิศวกรรมงานระบบ 	บริหารและควบคุมการก่อสร้าง', '2023-01-19 09:57:15', '2023-01-19 09:58:32');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name_th` varchar(255) NOT NULL,
  `project_name_en` varchar(255) NOT NULL,
  `project_category` int(11) NOT NULL,
  `project_location_th` varchar(255) NOT NULL,
  `project_location_en` varchar(255) NOT NULL,
  `project_owner` int(11) NOT NULL,
  `project_scope` int(11) NOT NULL,
  `project_type` int(11) NOT NULL,
  `project_department` int(11) NOT NULL,
  `project_status` int(11) NOT NULL,
  `project_value` int(11) NOT NULL,
  `project_area` int(11) NOT NULL,
  `project_description_th` text NOT NULL,
  `project_description_en` text NOT NULL,
  `project_image` text,
  `project_year_of_commencement` varchar(50) NOT NULL,
  `project_year_of_completion` varchar(50) NOT NULL,
  `project_active` enum('1','0') NOT NULL DEFAULT '0',
  `project_action` varchar(50) NOT NULL,
  `project_reviewstatus` varchar(50) DEFAULT NULL,
  `project_remarkstatus` text,
  `created_at` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `project`
--

INSERT INTO `project` (`project_id`, `project_name_th`, `project_name_en`, `project_category`, `project_location_th`, `project_location_en`, `project_owner`, `project_scope`, `project_type`, `project_department`, `project_status`, `project_value`, `project_area`, `project_description_th`, `project_description_en`, `project_image`, `project_year_of_commencement`, `project_year_of_completion`, `project_active`, `project_action`, `project_reviewstatus`, `project_remarkstatus`, `created_at`, `user_created`, `updated_at`, `user_updated`) VALUES
(1, 'อาคารคลังและศูนย์กระจายสินค้า แห่งใหม่ องค์การเภสัชกรรม คลอง 10', 'Warehouse building and distribution center New location, Government Pharmaceutical Organization, Khl', 1, '138 ม.4 ถ.รังสิต-นครนายก  คลอง 10 ต.บึงสนั่น 	อ.ธัญบุรี จ.ปทุมธานี\r\n', '138 Moo 4, Rangsit-Nakhon Nayok Road, Khlong 10, Bueng Sanan Subdistrict, Thanyaburi District, Pathum Thani Province', 1, 6, 5, 2, 2, 800, 13972, 'อาคารคลังและศูนย์กระจายสินค้า\r\nสูง 30 เมตร จํานวน 1 อาคาร\r\n', 'Warehouse and distribution center building, height 30 meters, 1 building', '[\"warehouse building and distribution center new location, government pharmaceutical organization, khl-638d8cc74f4f0.jpg\"]', '2563', '0', '1', 'upload image', 'authorized', NULL, '2022-12-05 13:16:21', 'acsadmin', '2022-12-05 13:16:39', 'acsadmin'),
(2, 'สำนักงาน-โรงงาน (ห้องเย็น) CFDC  จ.สุราษฎร์ธานี ', 'Office - Factory (Cold Storage) CFDC Surat Thani Province', 1, 'ต.คลองไทร อ.ท่าฉาง จ.สุราษฎร์ธานี', 'Khlong Sai Subdistrict, Tha Chang District, Surat Thani Province', 2, 6, 5, 2, 3, 125, 12750, 'ประกอบด้วยอาคารสำนักงานสูง 3 ชั้น และโรงงาน (ห้องเย็น)\r\n', 'It consists of a 3-storey office building and a factory (cold storage).', '[\"office - factory (cold storage) cfdc surat thani province-638d8f9a4d888.jpg\"]', '0', '2559', '1', 'upload image', 'authorized', NULL, '2022-12-05 13:25:47', 'acsadmin', '2022-12-05 13:28:42', 'acsadmin'),
(3, 'โรงงาน Huhtamaki Thailand Plant 2', 'Huhtamaki Thailand Plant 2', 1, 'นิคมอตุสาหกรรมสมุทรสาคร   ถนนพระราม2   ต.ท่าทราย\r\nอ.เมือง  จ.สมุทรสาคร', 'Samut Sakhon Industrial Estate, Rama 2 Road, \r\nTha Sai SubdistrictMuang District, Samut Sakhon Province', 4, 7, 5, 2, 2, 114, 4003, 'ก่อสร้างต่อเติมดัดแปลงอาคารโรงงานสูง 2 ชั้น', 'Construction, addition, modification of a 2-storey factory building', '[\"huhtamaki thailand plant 2-6391737d8e69d.jpg\"]', '2565', '0', '1', 'upload image', 'authorized', NULL, '2022-12-08 12:17:36', 'acsadmin', '2022-12-08 12:22:06', 'acsadmin'),
(4, 'ไซมิส พระราม 9', 'Siamese Rama 9', 10, 'ถนนพระราม 9 เขตห้วยขวาง กรุงเทพมหานคร', 'Rama 9 Road, Huai Khwang District, Bangkok', 3, 6, 5, 2, 2, 10000, 115000, 'Mixed Use ขนาดใหญ่ 3 อาคาร Commercial , Office , Hotel, Service Residence และ Residence \r\nTower A โรงแรม High Rise 18 ชั้น 1 อาคาร\r\nTower B : Siamese Tower (ตรงกลาง) High Rise 38 ชั้น\r\nชั้น 1-3 : Commercial 33 ยูนิต ชั้น 4-5 : Office 46 ยูนิต\r\nชั้น 6-37 : Service Residence 1,143 ยูนิต\r\nTower C : Siamese Residence (ด้านหลัง) High Rise 29 ชั้น\r\nชั้น 1 : Commercial 8 ยูนิต   ชั้น 2-4 : Office 15 ยูนิต\r\nชั้น 5-27 : Residence 561 ยูนิต\r\nTower D : เป็นอาคารซ่อมบำรุงสูง 2 ชั้น\r\nที่จอดรถประมาณ 898 คัน คิดเป็น 43% (ไม่รวมจอดซ้อนคัน)\r\n', 'Large project divided into 3 buildings\r\n                 Tower A, High Rise Hotel, 18 floors, 1 building\r\n                 Tower B Siamese Tower High Rise 38 floors\r\n                 Tower C Siamese Residence High Rise 29 floors\r\n                 Tower D : is a 2-storey maintenance building.\r\n                 Approximately 898 parking spaces', '[\"siamese rama 9-63917a18c4e42.jpg\"]', '2563', '0', '1', 'upload image', 'authorized', NULL, '2022-12-08 12:44:35', 'acsadmin', '2022-12-20 14:40:51', 'acsadmin'),
(5, 'อาคารกายวิภาคทางคลีนิค สถาบันการแพทย์ จักรีนฤบดินทร์', 'Clinical Anatomy Building medical institution Chakri Naruebodin', 7, 'ตำบลบางปลา  อำเภอบางพลี จังหวัดสมุทรปราการ', 'Bang Pla Subdistrict, Bang Phli District, Samut Prakan Province', 6, 4, 5, 2, 2, 749, 33975, 'อาคารโครงสร้างคอนกรีตเสริมเหล็กสูง 7 ชั้น, ชั้นใต้ดิน 1 ชั้น, พื้นที่ใช้สอยอาคาร\r\nโดยประมาณ 33,975 ตารางเมตร และมีพื้นที่ภูมิทัศน์และงาน\r\nภายนอกอาคาร 12,710 ตารางเมตร\r\n', 'Reinforced concrete structure building with 7 floors, 1 basement floor, building usable areaApproximately 33,975 square meters and has landscape and work areas.\r\nOutside the building 12,710 square meters', '[\"clinical anatomy building medical institution chakri naruebodin-63b7c24ec21c7.jpg\"]', '2563', '0', '1', 'upload image', 'authorized', NULL, '2023-01-06 13:36:16', 'acsadmin', '2023-01-06 13:40:14', 'acsadmin'),
(6, 'ปรับปรุงอาคาร สก. ระยะที่ 1 รพ.จุฬา', 'Renovation of Sor Kor Building, Phase 1, Chula Hospital', 7, 'โรงพยาบาลจุฬาลงกรณ์  แขวงปทุมวัน เขตปทุมวัน\r\n', 'Chulalongkorn Hospital, Pathum Wan Subdistrict, Pathum Wan District', 7, 4, 5, 2, 2, 335, 4740, '***', '***', '[\"renovation of sor kor building, phase 1, chula hospital-63b7c3ee793ae.jpg\"]', '2562', '0', '1', 'upload image', 'authorized', NULL, '2023-01-06 13:46:55', 'acsadmin', '2023-01-06 13:47:10', 'acsadmin'),
(7, 'อาคารศูนย์บริการ การแพทย์ชั้นเลิศ  รพ.ศรีนครินทร์ ม.ขอนแก่น', 'service center building excellent medical Srinakarin Hospital, Khon Kaen University', 7, 'โรงพยาบาลศรีนครินทร์ ต.ในเมือง อ.เมือง จ.ขอนแก่น\r\n', 'Srinakarin Hospital, Nai Mueang Subdistrict, Mueang District, Khon Kaen Province', 8, 4, 5, 2, 2, 3900, 190350, 'ประกอบด้วย อาคารศูนย์บริการการแพทย์เฉพาะทางชั้นเลิศ สูง 20 ชั้น, อาคารสนับสนุนบริการทางการแพทย์ สูง 8 ชั้น, อาคารจอดรถพร้อมที่พัก สูง 12 ชั้น และ\r\nอาคารเรือนพักญาติ สูง 4 ชั้น\r\n', 'Consists of a 20-storey high-class medical service center building, supporting buildings for medical services8-storey medical building, 12-storey car park with accommodation and 4-storey residential building for relatives', '[\"service center building excellent medical srinakarin hospital, khon kaen university-63b7c668c8df0.jpg\"]', '2564', '0', '1', 'upload image', 'authorized', NULL, '2023-01-06 13:56:02', 'acsadmin', '2023-01-06 14:36:56', 'acsadmin'),
(8, 'ศูนย์บูรณาการบริการด้านการแพทย์และสาธารณสุข  รพ.จุฬาลงกรณ์', 'Center for the Integration of Medical and Public Health Services King Chulalongkorn Hospital', 7, 'โรงพยาบาลจุฬาลงกรณ์ ถนนพระราม 4 กรุงเทพฯ\r\n', 'Chulalongkorn Hospital, Rama 4 Road, Bangkok', 8, 4, 5, 2, 2, 2300, 42000, 'อาคารสูง 15 ชั้น  ชั้นใต้ดิน 4 ชั้น\r\n', '15-storey building, 4-storey basement', '[\"center for the integration of medical and public health services king chulalongkorn hospital-63b7c847b3188.jpg\"]', '2562-2563', '0', '1', 'upload image', 'authorized', NULL, '2023-01-06 14:04:09', 'acsadmin', '2023-01-06 14:05:43', 'acsadmin'),
(9, 'ศูนย์บริการสุขภาพแบบครบวงจรแห่งภาคเหนือ ม.แม่ฟ้าหลวง', 'Comprehensive Health Service Center of the North, Mae Fah Luang University', 7, 'ตำบลท่าสุด อำเภอเมืองเชียงราย จังหวัดเชียงราย', 'Tambon Tha Sut, Amphoe Mueang Chiang Rai Chiang Rai', 5, 6, 5, 2, 2, 389, 19000, 'ศูนย์ส่งเสริมพัฒนาสุขภาพและฟื้นฟู-ชะลอวัย \r\nสูง 9 ชั้น จำนวน 1 อาคาร	\r\n', 'Health Promotion and Rehabilitation Center - Anti-aging\r\n9 floors, 1 building', '[\"comprehensive health service center of the north, mae fah luang university-63b7d17648379.jpg\"]', '2564', '0', '1', 'upload image', 'authorized', NULL, '2023-01-06 14:44:38', 'acsadmin', '2023-01-06 14:44:54', 'acsadmin'),
(10, 'โรงพยาบาลวิมุต', 'Vimut Hospital', 7, 'ถนนพหลโยธิน เขตพญาไท กรุงเทพฯ\r\n', 'Phaholyothin Road, Phaya Thai District, Bangkok', 9, 6, 5, 2, 2, 2189, 55600, 'ประกอบด้วย อาคารโรงพยาบาลสูง 18 ชั้น	และชั้นใต้ดิน 4 ชั้น\r\n', 'It consists of an 18-storey hospital building and 4 basement floors.', '[\"vimut hospital-63b7d3354ce43.jpeg\"]', '2560', '2565', '1', 'upload image', 'authorized', NULL, '2023-01-06 14:52:01', 'acsadmin', '2023-01-06 14:52:21', 'acsadmin'),
(11, 'ศูนย์บริการสุขภาพ โรงพยาบาลเวชธานี', 'health service center Vejthani Hospital', 7, ' ซอยลาดพร้าว 111 คลองจั่น บางกะปิ กรุงเทพมหานคร\r\n', 'Soi Ladprao 111, Klongjan, Bangkapi, Bangkok', 10, 6, 5, 2, 3, 230, 5260, 'อาคารสูง 6 ชั้น  ชั้นใต้ดิน 2 ชั้น', '6 storey building, 2 basement floors', '[\"health service center vejthani hospital-63b7d5094180d.jpg\"]', '0', '2563', '1', 'upload image', 'authorized', NULL, '2023-01-06 14:57:46', 'acsadmin', '2023-01-06 15:00:09', 'acsadmin'),
(12, 'อาคารอินเตอร์เนชั่นแนล 3 โรงพยาบาลยันฮี', 'International Building 3, Yanhee Hospital', 7, 'ถ.จรัญสนิทวงศ์ แขวงบางอ้อ เขตบางพลัดกรุงเทพมหานคร', 'Charansanitwong Road, Bang Or Subdistrict, Bang Phlat District, Bangkok', 11, 6, 5, 2, 3, 660, 20650, 'ประกอบด้วย อาคารโรงพยาบาลสูง 13 ชั้น และชั้นใต้ดิน 1 ชั้น \r\n', 'Consists of a 13-storey hospital building\r\nand 1 basement floor', '[\"international building 3, yanhee hospital-63b7d69e7324a.jpg\"]', '0', '2562', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:06:37', 'acsadmin', '2023-01-06 15:06:54', 'acsadmin'),
(13, 'อาคารศูนย์การแพทย์ มหาวิทยาลัยแม่ฟ้า', 'medical center building Mae Fah University', 7, 'ตำบลท่าสุด อำเภอเมืองเชียงราย จังหวัดเชียงราย', 'Tambon Tha Sut, Amphoe Mueang Chiang Rai Chiang Rai', 5, 6, 5, 2, 3, 1480, 52000, 'ประกอบด้วย อาคารศูนย์การแพทย์ พร้อม\r\nระบบสาธารณูปการ สูง 15 ชั้น จำนวน 1 อาคาร\r\n', 'It consists of a medical center building with\r\nPublic utility system, 15 floors high, 1 building', '[\"medical center building mae fah university-63b7d7b5b860b.jpg\"]', '0', '2561', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:11:11', 'acsadmin', '2023-01-06 15:11:33', 'acsadmin'),
(14, 'อาคารพิเคราะห์บำบัดโรคและบริการ  มหาวิทยาลัยแม่ฟ้าหลวง', 'Clinical and therapeutic services building Mae Fah Luang University', 7, 'ตำบลท่าสุด อำเภอเมืองเชียงราย จังหวัดเชียงราย\r\n', 'Tambon Tha Sut, Amphoe Mueang Chiang Rai Chiang Rai', 5, 6, 5, 2, 3, 1254, 36000, 'ประกอบด้วย อาคารที่มีระบบวิศวกรรมทางการแพทย์ 	พร้อมระบบสาธารณูปการ สูง 6 ชั้น และ 5 ชั้น\r\n', 'Consists of a building with a medical engineering system with public facilities, 6 floors and 5 floors', '[\"clinical and therapeutic services building mae fah luang university-63b7d93be2576.jpg\"]', '0', '2561', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:13:59', 'acsadmin', '2023-01-06 15:18:03', 'acsadmin'),
(15, 'สถาบันทางการแพทย์จักรีนฤบดินทร์', 'Chakri Naruebodindra Medical Institute', 7, 'อำเภอบางพลี จังหวัดสมุทรปราการ\r\n', 'Bang Phli District, Samut Prakan Province', 6, 6, 5, 2, 3, 5130, 372430, 'กลุ่มอาคาร โรงพยาบาล ประกอบด้วยอาคาร 4 กลุ่ม	ได้แก่ ส่วนอาคารบริการทางการแพทย์ ส่วนอาคาร	การศึกษา ส่วนอาคารที่พักอาศัยส่วนกลาง	และสาธารณูปโภค\r\n', 'The hospital building group consists of 4 groups of buildings, namely the medical service building, the education building, and the central residential building. and utilities', '[\"chakri naruebodindra medical institute-63bfb408548b9.jpeg\",\"chakri naruebodindra medical institute-63bfb40854ae0.jpg\"]', '0', '2560', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:22:37', 'acsadmin', '2023-01-12 14:17:28', 'acsadmin'),
(16, 'อาคารภูมิสิริมังคลานุสรณ์ อาคารศูนย์ความเป็นเลิศทางการแพทย์ โรงพยาบาล', 'Bhumisiri Mangkhalanuson Building Center of Excellence Medical Building Hospital', 7, 'โรงพยาบาลจุฬาลงกรณ์ ถนนพระราม 4 กรุงเทพฯ\r\n', 'Chulalongkorn Hospital, Rama 4 Road, Bangkok', 7, 1, 21, 9, 3, 6500, 30601, 'อาคารรักษาพยาบาล ศูนย์อุบัติเหตุ-บริการฉุกเฉินและ\r\nอาคารศูนย์ความเป็นเลิศทางการแพทย์สูง 29 ชั้น และชั้นใต้ดิน 4 ชั้น\r\n', 'medical building Accident Center - Emergency Services and\r\n29-storey medical center of excellence building\r\nand 4 basement floors', '[\"bhumisiri mangkhalanuson building center of excellence medical building hospital-63b7dcc6d258b.jpeg\"]', '0', '2558', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:30:46', 'acsadmin', '2023-01-06 15:33:10', 'acsadmin'),
(17, 'อาคารสิรินธร (เพื่อดูแลผู้สูงอายุ)', 'Sirindhorn Building (for elderly care)', 7, 'โรงพยาบาลจุฬาลงกรณ์ ถนนพระราม 4 กรุงเทพฯ', 'Chulalongkorn Hospital, Rama 4 Road, Bangkok', 7, 3, 21, 9, 3, 1185, 30000, 'อาคารรักษาพยาบาลเพื่อผู้สูงอายุ สูง 20 ชั้น \r\nชั้นใต้ดิน 1 ชั้น\r\n', 'Hospital building for the elderly, 20 floors high1 basement floor', '[\"sirindhorn building (for elderly care)-63bfb7a3762c1.jpg\",\"sirindhorn building (for elderly care)-63bfb7a3765cb.jpg\"]', '0', '2557', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:36:20', 'acsadmin', '2023-01-12 14:32:51', 'acsadmin'),
(18, 'อาคารศูนย์ซักฟอกทำความสะอาดฯ  ศูนย์โภชนาการ โรงพยาบาลจุฬาลงกรณ์', 'Building cleaning center nutrition center Chulalongkorn Hospital', 7, 'โรงพยาบาลจุฬาลงกรณ์ ถนนพระราม 4 กรุงเทพฯ\r\n', 'Chulalongkorn Hospital, Rama 4 Road, Bangkok', 7, 3, 22, 9, 3, 700, 32000, 'โครงการประกอบด้วย ศูนย์กลางทำความสะอาด\r\nเครื่องมือและอุปกรณ์ทางการแพทย์ ศูนย์ซักรีด \r\nศูนย์โภชนวิทยาและโภชนบำบัดสำนักงานบริหารและส่วนบริการ\r\n', 'The project consists of cleaning center\r\nMedical tools and equipment Laundry center\r\nCenter for Nutrition and Nutrition Therapy, Administration Office\r\nand service', '[\"building cleaning center nutrition center chulalongkorn hospital-63b7deb455704.jpg\"]', '0', '2556', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:41:12', 'acsadmin', '2023-01-10 13:03:24', 'acsadmin'),
(19, 'อาคารศูนย์การแพทย์บางโพ โรงพยาบาลบางโพ', 'Bang Pho Medical Center Building Bang Pho Hospital', 7, 'ถนนประชาราษฎร์  กรุงเทพมหานคร\r\n', 'Pracharat Road Bangkok', 12, 6, 5, 2, 3, 244, 9000, 'อาคารผู้ป่วยนอก สูง 6 ชั้น (ชั้นใต้ดิน 2 ชั้น) ความสูง 23 เมตร ชั้นใต้ดินสำหรับติดตั้งระบบ \r\nชั้น 1-5 เป็นอาคารผู้ป่วยนอก และชั้น 6 เป็นส่วนสำนักงานและห้องประชุม\r\n', 'Outpatient building, 6 floors (2 basement floors)\r\nHeight 23 meters, basement for system installation\r\nFloors 1-5 are outpatient buildings and 6th floor\r\nIt is an office and meeting room.', '[\"bang pho medical center building bang pho hospital-63b7e068246fc.jpg\"]', '0', '2556', '1', 'upload image', 'authorized', NULL, '2023-01-06 15:48:20', 'acsadmin', '2023-01-06 15:48:40', 'acsadmin'),
(20, 'อาคารอินเตอร์ 2 โรงพยาบาลยันฮี', 'Inter Building 2, Yanhee Hospital', 7, 'ถนนจรัญสนิทวงศ์  กรุงเทพฯ\r\n', 'Charansanitwong Road, Bangkok', 11, 6, 5, 2, 3, 408, 11215, 'ประกอบด้วยอาคารสูง 10 ชั้น มีชั้นใต้ดิน 2 ชั้นใต้ดิน 2 ชั้น', 'It consists of a 10-storey building with 2 basement floors and 2 basement floors.', '[\"inter building 2, yanhee hospital-63b821010d722.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-01-06 20:23:37', 'acsadmin', '2023-01-06 20:24:17', 'acsadmin'),
(21, 'อาคารสมเด็จพระเทพรัตน์', 'Somdet Phra Debarat Building', 7, 'ถนนพระรามที่ 6 กรุงเทพมหานคร', 'Rama VI Road, Bangkok', 6, 1, 21, 9, 3, 1470, 99552, 'อาคารโรงพยาบาลสูง 9 ชั้น มีชั้นใต้ดิน 3 ชั้น หอพักผู้ป่วย 340 เตียง ที่จอดรถ 549 คัน \r\n', '9-storey hospital building with 3 basement floors, 340-bed dormitory, 549 parking spaces', '[\"somdet phra debarat building-63b82230cea7b.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-06 20:29:03', 'acsadmin', '2023-01-06 20:29:20', 'acsadmin'),
(22, 'โรงพยาบาลกรุงเทพคริสเตียน ส่วนขยาย', 'The Bangkok Christian Hospital Extension', 7, 'ตั้งอยู่ริมถนนสีลม เลขที่ 124  แขวงสุริยวงศ์ เขตบางรัก กรุงเทพมหานคร \r\n10500', '124 Si Lom, Suriya Wong, Bang Rak, Bangkok 10500', 13, 6, 5, 2, 3, 940, 46066, 'อาคารหลังใหม่จำนวน 2 อาคาร อาคาร A สูง 15 ชั้น และชั้นใต้ดิน 1 ชั้น มีเตียงผู้ป่วย 245 เตียง อาคารB เป็นอาคารอเนกประสงค์ สูง 5 ชั้น และ\r\nชั้นใต้ดิน 1 ชั้น มีเตียงผู้ป่วย 35 เตียง\r\n', '2 new buildings, Building A, 15 floors high\r\nand 1 basement floor with 245 patient beds\r\nBuilding B is a multi-purpose building, 5 floors high and\r\n1 basement floor with 35 patient beds', '[\"the bangkok christian hospital extension-63b8242360426.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-06 20:37:05', 'acsadmin', '2023-01-06 20:37:39', 'acsadmin'),
(23, 'อาคารเวชศาสตร์ ฉุกเฉิน และศูนย์โรคหัวใจ วชิรพยาบาล (ตึกเพชรรัตน์)', 'Emergency Medicine Building and Cardiology Center, Vajira Hospital (Petcharat Building)', 7, 'ถนนสามเสน กรุงเทพมหานคร', 'Samsen Road, Bangkok', 14, 6, 5, 2, 3, 869, 55000, 'อาคารคอนกรีตเสริมเหล็กสูง 20 ชั้น ชั้นใต้ดิน 3 ชั้น	สำหรับจอดรถได้ 240 คัน\r\n', '20-storey reinforced concrete building, 3-storey basement for 240 parking spaces.', '[\"emergency medicine building and cardiology center, vajira hospital (petcharat building)-63bfa9b7bed41.jpg\",\"emergency medicine building and cardiology center, vajira hospital (petcharat building)-63bfa9b7bef01.jpg\"]', '0', '2545', '1', 'upload image', 'authorized', NULL, '2023-01-06 20:56:01', 'acsadmin', '2023-01-12 13:33:27', 'acsadmin'),
(24, 'โรงพยาบาลยันฮี', 'Yanhee Hospital', 7, 'ถนนจรัญสนิทวงศ์  กรุงเทพมหานคร', 'Charansanitwong Road', 11, 6, 5, 2, 3, 488, 44600, 'อาคารโรงพยาบาลคอนกรีตเสริมเหล้กสูง 10 ชั้น	และชั้นใต้ดิน 1 ชั้น\r\n', 'Reinforced concrete hospital building with 10 floors and 1 basement floor', '[\"yanhee hospital-63b994621e8ae.jpg\"]', '0', '2540', '1', 'upload image', 'authorized', NULL, '2023-01-06 21:00:28', 'acsadmin', '2023-01-07 22:48:50', 'acsadmin'),
(25, 'โรงพยาบาลกรุงเทพ ซอยศูนย์วิจัย ', 'Bangkok Hospital Soi Soonvijai', 7, 'เลขที่  2 ซอยศูนย์วิจัย 7 ถนนเพชรบุรีตัดใหม่ แขวงบางกะปิ กรุงเทพมหานคร 10310 ', 'No. 2 Soi Soonvijai 7, New Petchburi Road, Bangkapi Subdistrict, Bangkok 10310', 15, 6, 5, 2, 3, 535, 60000, 'อาคารโรงพยาบาลขนาด 300 เตียง สูง 15 ชั้น \r\n(63 เมตร) มีชั้นใต้ดิน 1 ชั้น อาคารจอดรถ 10 ชั้น\r\n', '300-bed hospital building, 15 floors high\r\n(63 meters) with 1 basement floor, 10-storey car park building', '[\"bangkok hospital soi soonvijai-63b82d7c58e03.jpg\"]', '0', '2537', '1', 'upload image', 'authorized', NULL, '2023-01-06 21:10:50', 'acsadmin', '2023-01-06 21:18:09', 'acsadmin'),
(26, 'โรงพยาบาลหัวใจกรุงเทพ', 'Bangkok Heart Hospital', 7, '2 ถ. เพชรบุรี แขวง บางกะปิ เขตห้วยขวาง กรุงเทพมหานคร 10310', '2 Phetchaburi Road, Bangkapi Subdistrict, Huai Khwang District, Bangkok 10310', 16, 6, 5, 2, 3, 141, 8100, 'อาคารโรงพยาบาลหลังใหม่ สูง 6 ชั้น และชั้นใต้ดิน 1 ชั้น\r\n', 'New hospital building, 6 floors highand 1 basement floor', '[\"bangkok heart hospital-63b9193617053.jpg\"]', '0', '2547', '1', 'upload image', 'authorized', NULL, '2023-01-07 14:02:44', 'acsadmin', '2023-01-07 14:03:18', 'acsadmin'),
(27, 'โรงพยาบาลกรุงเทพ หาดใหญ่', 'Bangkok Hospital Hat Yai', 7, 'อำเภอหาดใหญ่ จังหวัดสงขลา', 'Hat Yai District, Songkhla Province', 15, 6, 5, 2, 3, 530, 55000, 'อาคารคอนกรีตเสริมเหล็ก 12 ชั้น\r\n', '12-storey reinforced concrete building', '[\"bangkok hospital hat yai-63b97fb6e3df3.jpg\"]', '0', '2540', '1', 'upload image', 'authorized', NULL, '2023-01-07 21:20:12', 'acsadmin', '2023-01-07 21:20:38', 'acsadmin'),
(28, 'โรงพยาบาลกรุงเทพ ภูเก็ต', 'Bangkok Hospital Phuket', 7, 'อำเภอเมือง  จังหวัดภูเก็ต', 'Muang District, Phuket Province', 15, 6, 5, 2, 3, 800, 30000, 'โรงพยาบาลสูง  5 ชั้น ขนาด 300 เตียง และอาคารอเนกประสงค์สูง 5 ชั้น', '5-storeys hospital with 300 beds and a 5 storeys multi-purpose building', '[\"bangkok hospital phuket-63b982f04fd24.jpg\"]', '0', '2538', '1', 'upload image', 'authorized', NULL, '2023-01-07 21:33:53', 'acsadmin', '2023-01-07 21:34:24', 'acsadmin'),
(29, 'โรงพยาบาลกรุงเทพตราด', 'Bangkok  Hospital  Trad', 7, 'อำเภอเมือง  จังหวัดตราด\r\n', 'Muang District, Trat Province', 15, 6, 5, 2, 3, 224, 20000, 'อาคารโรงพยาบาลสูง 6 ชั้น ขนาด 100 เตียง และอาคารบริการ สูง 2 ชั้น\r\n', '6-storey hospital building with 100 beds and 2-storey service building', '[\"bangkok  hospital  trad-63b98577cab46.jpg\"]', '0', '2539', '1', 'upload image', 'authorized', NULL, '2023-01-07 21:44:53', 'acsadmin', '2023-01-07 21:45:11', 'acsadmin'),
(30, 'โรงพยาบาลอินเตอร์เวชการ หรือ โรงพยาบาลพิษณุโลก ฮอสพิทอล', 'Phitsanulok Hospital (Formerly Inter-Medical Hospital)', 7, 'ถนน บรมไตรโลกนาถ จังหวัดพิษณุโลก\r\n', 'Borom Trailokkanat Road Phitsanulok Province', 17, 6, 5, 2, 3, 150, 12000, 'อาคารโรงพยาบาลสูง 9 ชั้น ขนาด 300 เตียง  มีชั้นใต้ดิน 1 ชั้น\r\n จำนวน 1 หลัง และอาคารบริการสูง 2 ชั้น จำนวน 1 หลัง\r\n', '9-storey hospital building, 300 beds, with 1 basement floor\r\n 1 building and 1 service building with 2 floors', '[\"phitsanulok hospital (formerly inter-medical hospital)-63b98b7096dc8.jpg\",\"phitsanulok hospital (formerly inter-medical hospital)-63b98b7096f96.jpg\"]', '0', '2539', '1', 'upload image', 'authorized', NULL, '2023-01-07 22:05:01', 'acsadmin', '2023-01-07 22:10:40', 'acsadmin'),
(31, 'โรงพยาบาลเซ็นทรัลเยนเนอรัล เฟส 2 ', 'Central General Hospital Phase 2', 7, '290 ถ. พหลโยธิน แขวง อนุสาวรีย์ เขตบางเขน กรุงเทพมหานคร 10220', '290 Phaholyothin Road, Anusawari Subdistrict, Bang Khen District, Bangkok 10220', 18, 6, 5, 2, 3, 83, 9030, 'อาคารโรงพยาบาลคอนกรีตเสริมเหล็กสูง 8 ชั้น ขนาด 120 เตียง\r\n', 'Reinforced concrete hospital building, 8 floors, 120 beds', '[\"central general hospital phase 2-63b98e3a19d50.jpg\",\"central general hospital phase 2-63b98e3a19f87.jpg\"]', '0', '2539', '1', 'upload image', 'authorized', NULL, '2023-01-07 22:22:12', 'acsadmin', '2023-01-07 22:22:34', 'acsadmin'),
(32, 'โรงพยาบาลเวชธานี', 'Vejthani Hospital', 7, 'ซอยลาดพร้าว 111 กรุงเทพมหานคร', 'Soi Ladprao 111, Bangkok', 10, 6, 5, 2, 3, 493, 50000, 'อาคารโรงพยาบาลสูง 12 ชั้น และชั้นใต้ดิน 1 ชั้น 	ขนาด 500 เตียง จำนวน 2 อาคาร\r\n', 'Two 12-Storey buildings with 1 basement, 500  beds', '[\"vejthani hospital-63bf9ac2af346.jpg\"]', '0', '2537', '1', 'upload image', 'authorized', NULL, '2023-01-12 12:29:07', 'acsadmin', '2023-01-12 12:29:38', 'acsadmin'),
(33, 'ตึกสยามมินทร์  โรงพยาบาลศิริราช', 'Syamindra Building , Siriraj Hospital', 7, '2 ถ. อรุณอมรินทร์ แขวงศิริราช เขตบางกอกน้อย กรุงเทพมหานคร 10700\r\n', '2 Arun Amarin Road, Siriraj Subdistrict, Bangkok Noi District Bangkok 10700', 19, 1, 21, 9, 3, 900, 80000, 'อาคารสูง 15 ชั้น และชั้นใต้ดิน 1 ชั้น\r\n', '15-Storey Hospital facilities with 1 Basements', '[\"syamindra building , siriraj hospital-63bf9efa9249f.jpg\"]', '0', '2534', '1', 'upload image', 'authorized', NULL, '2023-01-12 12:47:19', 'acsadmin', '2023-01-12 12:47:38', 'acsadmin'),
(34, 'โรงพยาบาลพระรามเก้า', 'Praram 9 Hospital', 7, '99 ถนน พระราม 9 แขวง บางกะปิ เขตห้วยขวาง กรุงเทพมหานคร 10310', '99 Rama 9 Road, Bangkapi Subdistrict, Huai Khwang District, Bangkok 10310', 20, 1, 21, 9, 3, 400, 40000, 'อาคารโรงพยาบาลสูง 15 ชั้น 300 เตียง', '15 Storeys , 300 Beds Hospital', '[\"praram 9 hospital-63bfa769066d5.jpg\"]', '0', '2535', '1', 'upload image', 'authorized', NULL, '2023-01-12 13:23:13', 'acsadmin', '2023-01-12 13:23:37', 'acsadmin'),
(35, 'ตึกอุบัติเหตุและฉุกเฉิน รพ.กล้วยน้ำไท', 'Accident and Emergency Building Kluaynamthai Hospital', 7, '80 ซอยแสงจันทร์-รูเบีย ถนนพระราม 4 แขวงพระโขนง เขตคลองเตย กรุงเทพมหานคร	\r\n', '80 Soi Saeng Chan-Rubia, Rama IV Road, Prakanong Subdistrict, Klongtoey District, Bangkok', 21, 6, 5, 2, 3, 1020, 4424, 'อาคารโรงพยาบาลสูง 4 ชั้น ', '4-storey hospital building', '[\"accident and emergency building kluaynamthai hospital-63bfb24a8beef.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-01-12 14:09:43', 'acsadmin', '2023-01-12 14:10:02', 'acsadmin'),
(36, 'โรงพยาบาลกรุงเทพพัมยา , หอพักผู้ป่วยใน', 'Bangkok Hospital Pattaya , Inpatient dormitory', 7, 'ถนนสุขุมวิท ตำบลนาเกลือ อำเภอบางละมุง จังหวัดชลบุรี', 'Sukhumvit Road, Na Kluea Subdistrict, Bang Lamung District, Chonburi', 15, 4, 5, 2, 3, 187, 8625, 'หอพักผู้ป่วยใน จำนวน 59 ยูนิต', '59 units of Inpatient dormitory', '[\"bangkok hospital pattaya , inpatient dormitory-63c2770a019c4.jpg\"]', '0', '2545', '1', 'upload image', 'authorized', NULL, '2023-01-14 16:33:29', 'acsadmin', '2023-01-14 16:34:02', 'acsadmin'),
(37, 'อาคารอุปการเวชชกิจ โรงพยาบาลจุฬาลงกรณ์ สภากาชาดไทย', 'Uppakarn Vejjakij Building, Chulalongkorn Hospital', 7, '1873 ถ. อังรีดูนังต์ แขวง ปทุมวัน เขตปทุมวัน กรุงเทพมหานคร 10330', 'Henry Dunant Rd., Bangkok', 7, 1, 21, 9, 3, 702, 32000, 'อาคารสูง 7 ชั้น 1 ชั้นใต้ดิน\r\nสำหรับ Central Sterile Supply และศูนย์อาหาร', '7-storey building with 1 basement\r\nfor Central Sterile Supply and Food Court', '[\"uppakarn vejjakij building, chulalongkorn hospital-63c279bea23dc.jpg\"]', '0', '2556', '1', 'upload image', 'authorized', NULL, '2023-01-14 16:45:15', 'acsadmin', '2023-01-14 16:45:34', 'acsadmin'),
(38, 'ศูนย์บูรณาการการแพทย์และสาธารณสุข รพ.จุฬาฯ', 'Center for Integration of Medical and Public Health Services, Chulalongkorn Hospital', 7, 'ถนนราชดำริ กรุงเทพมหานคร', 'Ratchdamri Rd., Bangkok', 7, 6, 5, 2, 2, 2300, 42000, 'สูง 15 ชั้น มี 4 ชั้นใต้ดิน สำหรับ OPD', '15 storeys with 4 basement for OPD', '[\"center for integration of medical and public health services, chulalongkorn hospital-63c352bce4844.jpg\"]', '2565', '0', '1', 'upload image', 'authorized', NULL, '2023-01-15 08:11:02', 'acsadmin', '2023-01-15 08:11:24', 'acsadmin'),
(39, 'ศูนย์ฉุกเฉินและอุบัติเหตุ โรงพยาบาลรามาธิบดี', 'Emergency and Trauma Center Ramathibodi Hospital', 7, 'ถ.พระราม 4 กทม', 'Rama IV Rd., Bangkok', 6, 2, 1, 8, 3, 250, 12300, 'สิ่งอำนวยความสะดวกแผนกฉุกเฉิน', 'Emergency Department facilities', '[\"emergency and trauma center ramathibodi hospital-63c3593ddd3a4.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-15 08:38:13', 'acsadmin', '2023-01-15 08:39:09', 'acsadmin'),
(40, 'อาคารเฉลิมพระเกียรติ 50 พรรษา สมเด็จพระเทพรัตนราชสุดาฯ สยามบรมราชกุมารี', '50 Anniversary Chalermprakiet Her Royal Highness Crown Princess Maha Chakri Sirindhorn Building', 7, 'ถนนโยธี  กรุงเทพมาหนคร', 'Yothi Rd., Bangkok', 22, 2, 1, 8, 3, 1600, 97309, 'โรงพยาบาลทันตกรรม 580 ยูนิต', '580 units Dentistry Hospital', '[\"50 anniversary chalermprakiet her royal highness crown princess maha chakri sirindhorn building-63c363eaa49cc.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-01-15 09:22:31', 'acsadmin', '2023-01-15 09:24:42', 'acsadmin'),
(41, 'โรงพยาบาลศิริราช ปิยมหาราชการุณย์', 'Siriraj Piyamaharajkarun Hospital', 7, 'ถนนวังหลัง กรุงเทพมหานคร', 'Wang Lang Rd. , Bangkok', 19, 2, 1, 8, 3, 7000, 165270, 'สูง 14 ชั้น 344 เตียง พร้อม\r\nเครื่องมือแพทย์ที่ทันสมัย', '14 storeys, 344 beds with\r\nstate-of-the-art medical instruments', '[\"siriraj piyamaharajkarun hospital-63c3666fb782f.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-01-15 09:35:01', 'acsadmin', '2023-01-15 09:35:27', 'acsadmin'),
(42, 'North Plot At Forestias  ', 'North Plot At Forestias  ', 10, 'ถนนบางนา-ตราด กิโลเตรที่ 7 ตำบลบางแก้ว อำเภอบางพลี  จังหวัดสมุทราปราการ\r\n', 'Bangna-Trad Road, Kilometer 7, Bang Kaeo Subdistrict, Bang Phli District, Samut Prakan Province', 23, 6, 5, 2, 2, 90000, 238000, 'รอข้อมูล', 'wait for information', '[\"north plot at forestias  -63c602135f4d0.jpg\"]', '2563', '-', '1', 'upload image', 'authorized', NULL, '2023-01-17 09:03:37', 'acsadmin', '2023-01-17 09:04:03', 'acsadmin'),
(43, 'ตึกช้าง', 'Elephant Tower', 10, 'ถนนพหลโยธิน  กรุงเทพมหานคร', 'Phaholyothin Road, Bangkok', 24, 10, 23, 9, 3, 1400, 140000, 'อาคารสูง 32 ชั้น รวม 3 อาคาร เพื่อใช้เป็น 	สำนักงาน  ห้องชุด ส่วนพล่าซ่าและที่จอดรถโดยมีส่วนเชื่อมต่อบนอาคาร ชั้นที่ 25-32\r\n', 'A 32-storey building, including 3 buildings, for use as offices, suites, plazas and parking spaces.There is a connection on the 25th-32nd floor of the building.', '[\"elephant tower-63c628cd9adbd.jpg\",\"elephant tower-63c628cd9afdd.jpg\"]', '2538', '2541', '1', 'upload image', 'authorized', NULL, '2023-01-17 11:44:25', 'acsadmin', '2023-01-17 11:49:17', 'acsadmin'),
(44, 'ศูนย์กระจายสินค้า RDC จ. สุราษฎร์ธานี  (ส่วนขยาย)  ', 'RDC Distribution Center, Surat Thani Province (extension)', 1, 'ต.คลองไทร อ.ท่าฉาง จ.สุราษฎร์ธานี\r\n', 'Khlong Sai Subdistrict, Tha Chang District, Surat Thani Province', 2, 6, 5, 2, 3, 65, 4286, 'ประกอบด้วยอาคารศูนย์กระจายสินค้า \r\nDry Grocery พร้อมงานถนนและที่จอดรถ\r\n', 'It consists of a distribution center building.\r\nDry Grocery with road work and parking', '[\"rdc distribution center, surat thani province (extension)-63c62a60d5180.jpg\"]', '0', '2559', '1', 'upload image', 'authorized', NULL, '2023-01-17 11:54:39', 'acsadmin', '2023-01-17 11:56:00', 'acsadmin'),
(45, 'RDC & CDC ขอนแก่น (ส่วนขยาย)', 'RDC & CDC Khon Kaen (Expansion)', 1, 'ถนนท่าพระ-โกสุม  อ.เมือง จ.ขอนแก่น\r\n', 'Tha Phra-Kosum Road, Muang District, Khon Kaen Province', 2, 6, 5, 2, 3, 146, 9357, 'ประกอบด้วยอาคารกระจายสินค้า 1 อาคาร 	และอาคารกระจายสินค้าแช่เย็น 1 อาคาร\r\n', 'Consists of 1 distribution building and 1 refrigerated distribution building', '[\"rdc & cdc khon kaen (expansion)-63c62b5c29b44.jpg\"]', '0', '2557', '1', 'upload image', 'authorized', NULL, '2023-01-17 11:59:08', 'acsadmin', '2023-01-17 12:00:12', 'acsadmin'),
(46, 'Electronics Factory (GPV-E)', 'Electronics Factory (GPV-E)', 1, 'นิคมอุตสาหกรรมบางปู  ตำบลแพรกษา อำเภอเมือง จ.สมุทรปราการ\r\n\r\n', 'Bangpoo Industrial Estate, Phraeksa Subdistrict Muang District, Samut Prakan Province', 25, 6, 5, 2, 3, 401, 13145, 'ประกอบด้วยอาคารโรงงานสูง 1 ชั้น พร้อมชั้นลอย ในส่วนของสำนักงาน\r\n', 'It consists of a 1-storey factory building with a mezzanine floor in the office area.', '[\"electronics factory (gpv-e)-63c62cbf15d69.jpg\"]', '0', '2558', '1', 'upload image', 'authorized', NULL, '2023-01-17 12:04:12', 'acsadmin', '2023-01-17 12:06:07', 'acsadmin'),
(47, 'Mechanical Factory (GPV-M)', 'Mechanical Factory (GPV-M)', 1, 'นิคมอุตสาหกรรมบางปู  ตำบลแพรกษา อำเภอเมือง จังหวัดสมุทรปราการ', 'Bangpoo Industrial Estate, Phraeksa Subdistrict\r\nMuang District, Samut Prakan Province', 25, 6, 5, 2, 3, 208, 8160, 'ประกอบด้วยอาคารโรงงาน 1 ชั้น พร้อมชั้นลอย ในส่วนของสำนักงาน\r\n', 'It consists of a 1-storey factory building with a mezzanine floor in the office area.', '[\"mechanical factory (gpv-m)-63c6345a4680d.jpg\"]', '0', '2557', '1', 'upload image', 'authorized', NULL, '2023-01-17 12:33:07', 'acsadmin', '2023-01-17 12:38:34', 'acsadmin'),
(48, 'อาคาร MJ6 บริษัท แมริโกต์ จิวเวลรี่ (ประเทศไทย) จำกัด', 'MJ6 Building,Marigot Jewellery (Thailand) Co., Ltd.', 1, 'นิคมอุตสาหกรรม Hi-Tech จังหวัดพระนครศรีอยุธยา\r\n', 'Hi-Tech Industrial Estate, Phra Nakhon Si Ayutthaya Province', 26, 11, 24, 10, 3, 210, 18000, 'อาคารโรงงานพร้อมสำนักงาน 4 ชั้น และ 2 ชั้น\r\n', 'Factory building with 4-storey and 2-storey offices', '[\"mj6 building,marigot jewellery (thailand) co., ltd.-63c63689cc389.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-01-17 12:46:18', 'acsadmin', '2023-01-19 10:00:15', 'acsadmin'),
(49, 'อาคารคลังสินค้า A4', 'A4 warehouse building', 1, 'เทศบาลแหลมฉบัง จ.ชลบุรี\r\n', 'Laem Chabang Municipality, Chonburi Province', 27, 6, 5, 2, 3, 89, 5640, 'อาคารโกดัง จำนวน 2 หลัง\r\n', '2 warehouse buildings', '[\"a4 warehouse building-63c63c6488343.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-01-17 13:08:45', 'acsadmin', '2023-01-17 13:12:52', 'acsadmin'),
(50, 'อาคารคลังสินค้าและศูนย์บริการลูกค้า  DHL ถนนพระราม 3', 'Warehouse building and customer service center DHL Rama 3 Road', 1, 'ถนนพระราม 3 กรุงเทพมหานคร\r\n', 'Rama 3 Road, Bangkok', 28, 6, 5, 2, 3, 48, 5400, 'อาคารคลังสินค้าและศูนย์บริการลูกค้า\r\n', 'Warehouse building and customer service center', '[\"warehouse building and customer service center dhl rama 3 road-63c63e1059527.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-01-17 13:18:51', 'acsadmin', '2023-01-19 09:59:34', 'acsadmin'),
(51, 'ศูนย์กระจายสินค้า RDC KK - ขอนแก่น', 'Distribution Center RDC KK - Khon Kaen', 1, 'จังหวัดขอนแก่น', 'Khon Kaen Province', 2, 11, 24, 10, 3, 331, 10000, 'ศูนย์กระจายสินค้า', 'distribution center', '[\"distribution center rdc kk - khon kaen-63c89de864ecc.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-19 08:33:09', 'acsadmin', '2023-01-19 09:59:23', 'acsadmin'),
(52, 'ศูนย์กระจายสินค้าควบคุมอุณหภูมิ  CDC KK (ขอนแก่น) ', 'temperature controlled distribution center CDC KK (Khon Kaen)', 1, 'อำเภอเมือง จังหวัดขอนแก่น', 'Muang District, Khon Kaen Province', 2, 12, 25, 5, 3, 110, 3648, 'อาคารสูงกระจายสินค้าปรับอุณหภุมิและสำนักงานสูง 2 ชั้นประกอบด้วย ห้องเย็น สำนักงานและพื้นที่	สนับสนุนต่าง ๆ\r\n', 'high-rise buildings for distribution of temperature-controlled products and offices 2 storeys, consisting of cold storage, offices and various supporting areas ', '[\"temperature controlled distribution center cdc kk (khon kaen)-63c8a18ee4121.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-19 08:48:41', 'acsadmin', '2023-01-19 08:49:02', 'acsadmin'),
(53, 'อาคารคลังสินค้าและอาคารอำนวยความสะดวก Beger', 'Beger warehouse and facility building', 1, 'อำเภอพระสมุทรเจดีย์ จังหวัดสมุทรปราการ\r\n', 'Phra Samut Chedi District Samut Prakan Province', 29, 6, 5, 2, 2, 205, 14288, 'เป็นอาคารศูนย์กระจายสินค้า (D.C.) อาคารซ่อมบำรุง 	และอาคารโรงเก็บวัสดุขยะและ\r\nลานกองของ\r\n', 'It is a distribution center building (D.C.), a maintenance building. and a building for storage of waste materials and pile yard', '[\"beger warehouse and facility building-63c8a32c4abd8.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-19 08:55:39', 'acsadmin', '2023-01-19 08:55:56', 'acsadmin'),
(54, 'ส่วนขยายโรงงาน ซี และ ดี บจก. ซี.พี. ค้าปลีกและการตลาด ลาดหลุมแก้ว ปทุมธานี', 'C and D Factory Extension, C.P. Co., Ltd. Retail and Marketing Lat Lum Kaeo, Pathum Thani', 1, 'อ.ลาดหลุมแก้ว จังหวัดปทุมธานี\r\n', 'Lat Lum Kaew District Pathum Thani Province', 2, 6, 5, 2, 3, 100, 9041, 'ส่วนขยาย C และ D ประกอบด้วยอาคาร   ห้องเย็น 	Cold Storge chilled food สำนักงานอาคารโรงแป้ง 	และข้าวสารและอาคารอื่นๆ\r\n', 'Extensions C and D consist of cold storage buildings, Cold Storge chilled food, flour mill building offices. and rice and other buildings', '[\"c and d factory extension, c.p. co., ltd. retail and marketing lat lum kaeo, pathum thani-63c8a642a7374.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-19 09:08:43', 'acsadmin', '2023-01-19 09:09:06', 'acsadmin'),
(55, 'อาคารโรงงานพร้อมสำนักงาน-นิคมอุตสาหกรรมสินสาคร', 'Factory building with office - Sinsakhon Industrial Estate', 1, 'นิคมอุตสาหกรรมสินสาคร จ.สมุทรปราการ', 'Sinsakhon Industrial Estate Samut Prakan Province', 30, 6, 5, 2, 3, 60, 9600, 'โครงการ Warehouse 1 เป็นอาคารคลังสินค้าชั้นเดียว 	\r\nขนาด 80*120 เมตร\r\n', 'Warehouse 1 project is a single storey warehouse building.\r\nSize 80*120 m.', '[\"factory building with office - sinsakhon industrial estate-63c8af0f432c9.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-01-19 09:46:14', 'acsadmin', '2023-01-19 09:46:39', 'acsadmin'),
(56, 'โรงงานไมเนอร์ แดรี่ ส่วนขยาย เฟส 2', 'Minor Dairy Plant Expansion Phase 2', 1, 'จังหวัดสระบุรี', 'Saraburi Province', 31, 11, 25, 10, 3, 24, 1200, 'อาคารคลังสินค้า (ห้องเย็น) และอาคารสำนักงาน\r\n', 'Warehouse building (cold storage) and office building', '[\"minor dairy plant expansion phase 2-63c8b10f40e6c.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-01-19 09:54:03', 'acsadmin', '2023-01-19 09:58:58', 'acsadmin'),
(57, 'โรงงานไมเนอร์ แดรี่ ส่วนขยาย เฟส 3', 'Minor Dairy Factory Expansion Phase 3', 1, 'อำเภอปากช่อง จังหวัดนครราชสีมา\r\n', 'Pak Chong District, Nakhon Ratchasima Province', 31, 11, 24, 10, 3, 25, 2551, 'ส่วนขยายต่อเชื่อมกับอาคารเดิมประกอบด้วยโรงงาน \r\nสำนักงาน ห้องปฏิบัติการและโรงอาหาร\r\n', 'The extension connects to the original building consisting of a factory.\r\nOffices, laboratories and cafeterias', '[\"minor dairy factory expansion phase 3-63c8b38704bb3.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-01-19 10:05:20', 'acsadmin', '2023-01-19 10:05:43', 'acsadmin'),
(58, 'โครงการ Capacity Expansion โรงงาน  บริษัท ไมเนอร์ แดรี่ จำกัด', 'Factory Capacity Expansion Project Minor Dairy Company Limited', 1, 'อำเภอปากช่อง จังหวัดนครราชสีมา\r\n', 'Pak Chong District, Nakhon Ratchasima Province', 31, 6, 5, 2, 3, 25, 0, 'งานปรับปรุงห้อง 25 c เป็นห้อง -45c ประกอบด้วย \r\nAnte Room, Loading, Changing และ อาคาร Boiler\r\n', 'Renovation of room 25 c to room -45c consisting of\r\nAnte Room, Loading, Changing and Boiler Building', '[\"factory capacity expansion project minor dairy company limited-63c8b4bb7a722.jpg\"]', '0', '2550', '1', 'upload image', 'authorized', NULL, '2023-01-19 10:10:27', 'acsadmin', '2023-01-19 10:10:51', 'acsadmin'),
(59, 'โรงงานผลิตกระดาษ เอลีท คราฟท์ เปเปอร์', 'Paper Factory Elite Kraft Paper', 1, 'อำเภอเมือง จังหวัดสระแก้ว\r\n', 'Muang District, Sa Kaeo Province', 32, 11, 24, 10, 3, 450, 160000, 'อาคารโรงงาน อาคารโกดัง 	(Warehouse) และอาคาร อื่นๆ\r\n', 'Factory building, warehouse building (Warehouse)\r\nand other buildings', '[\"paper factory elite kraft paper-63c8b79e75e28.jpg\"]', '0', '2549', '1', 'upload image', 'authorized', NULL, '2023-01-19 10:22:36', 'acsadmin', '2023-01-19 10:23:10', 'acsadmin'),
(60, 'โครงการส่วนขยาย บจก. ซี.พี. ค้าปลีก และการตลาด นิคมอุตสาหกรรมลาดกระบัง', 'Expansion Project C.P. Retail Co., Ltd. and marketing Lat Krabang Industrial Estate', 1, 'นิคมอุตสาหกรรมลาดกระบัง กรุงเทพ\r\n', 'Ladkrabang Industrial Estate, Bangkok', 33, 6, 5, 2, 3, 28, 2500, 'โครงการก่อสร้างส่วนขยายประกอบด้วย อาคาร โรงงาน (โกดัง) ใช้เป็นโรงเก็บสินค้าและรับสินค้า 	บางส่วนใช้เป็นห้องเย็น ห้องอาหารและห้องประชุม\r\n\r\n', 'The expansion construction project consists of a factory building (warehouse) used as a warehouse and receiving goods. Some are used as cold rooms. Restaurant and meeting room', '[\"expansion project c.p. retail co., ltd. and marketing lat krabang industrial estate-63c8b8e713274.jpg\"]', '0', '2548', '1', 'upload image', 'authorized', NULL, '2023-01-19 10:28:08', 'acsadmin', '2023-01-19 10:28:39', 'acsadmin');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `project_category`
--

CREATE TABLE `project_category` (
  `pcategory_id` int(11) NOT NULL,
  `pcategory_name_th` varchar(255) NOT NULL,
  `pcategory_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `project_category`
--

INSERT INTO `project_category` (`pcategory_id`, `pcategory_name_th`, `pcategory_name_en`, `created_at`, `updated_at`) VALUES
(1, 'โรงงาน/คลังสินค้า', 'Industrial/Warehouse', '2022-08-10 15:00:55', NULL),
(2, 'โรงแรมและรีสอร์ท', 'Hotel & Resort', '2022-08-10 15:00:55', NULL),
(3, 'อาคารสำนักงาน', 'Office', '2022-08-10 15:02:04', NULL),
(4, 'อาคารพักอาศัย', 'Residential', '2022-08-10 15:02:04', NULL),
(5, 'ห้างสรรพสินค้า', 'Commercial Complex', '2022-08-10 15:02:25', NULL),
(6, 'อาคารสำนักงาน/พักอาศัย/สรรพสินค้า', 'Complex', '2022-08-10 15:02:25', NULL),
(7, 'โรงพยาบาล', 'Hospital', '2022-08-10 15:02:48', NULL),
(8, 'โครงสร้างพิเศษ', 'Special Structure', '2022-08-10 15:02:48', NULL),
(9, 'ตกแต่งภายใน', 'Interior Decoration', '2022-08-10 15:03:14', NULL),
(10, 'อาคารแบบผสมผสาน', 'Mixed-Use', '2022-12-05 13:57:20', NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `project_owner`
--

CREATE TABLE `project_owner` (
  `owner_id` int(11) NOT NULL,
  `owner_name_th` varchar(255) NOT NULL,
  `owner_name_en` varchar(255) NOT NULL,
  `owner_active` enum('1','0') NOT NULL DEFAULT '0',
  `owner_action` varchar(50) NOT NULL,
  `owner_reviewstatus` varchar(50) DEFAULT NULL,
  `owner_remarkstatus` text,
  `created_at` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `project_owner`
--

INSERT INTO `project_owner` (`owner_id`, `owner_name_th`, `owner_name_en`, `owner_active`, `owner_action`, `owner_reviewstatus`, `owner_remarkstatus`, `created_at`, `user_created`, `updated_at`, `user_updated`) VALUES
(1, 'องค์การเภสัชกรรม กระทรวงสาธารณสุข', 'the Government Pharmaceutical Organization (GPO) Thailand.', '1', 'create project owner', 'authorized', NULL, '2022-12-05 12:53:38', 'acsadmin', '2022-12-20 14:35:59', 'acsadmin'),
(2, 'บริษัท ซีพี ออลล์ จำกัด (มหาชน)', 'CP ALL PUBLIC COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2022-12-05 13:22:13', 'acsadmin', '2022-12-20 14:35:14', 'acsadmin'),
(3, 'บริษัท ไซมิส พระรามเก้า จำกัด', 'Siamese Rama 9 Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2022-12-05 13:55:21', 'acsadmin', '2022-12-20 14:35:03', 'acsadmin'),
(4, 'บริษัท ฮูทามากิ(ประเทศไทย) จำกัด', 'Huhtamaki Thailand Company Limited', '1', 'create project owner', 'authorized', NULL, '2022-12-08 11:54:57', 'acsadmin', '2022-12-20 14:34:41', 'acsadmin'),
(5, 'มหาวิทยาลัยแม่ฟ้าหลวง  จังหวัดเชียงราย', 'Mae Fah Luang University Chiang Rai', '1', 'create project owner', 'authorized', NULL, '2023-01-06 14:15:34', 'acsadmin', '2023-01-06 14:38:24', 'acsadmin'),
(6, 'คณะแพทย์ศาสตร์โรงพยาบาลรามาธิบดี  มหาวิทยาลัยมหิดล', 'Faculty of Medicine, Ramathibodi Hospital, Mahidol University', '1', 'create project owner', 'authorized', NULL, '2023-01-06 13:28:18', 'acsadmin', NULL, NULL),
(7, 'โรงพยาบาลจุฬาลงกรณ์ สภากาชาดไทย', 'king chulalongkorn memorial hospital the thai red cross society', '1', 'create project owner', 'authorized', NULL, '2023-01-06 13:43:14', 'acsadmin', NULL, NULL),
(8, 'โรงพยาบาลศรีนครินทร์ ม.ขอนแก่น', 'Srinagarind Hospital Khon Kaen University', '1', 'create project owner', 'authorized', NULL, '2023-01-06 13:51:32', 'acsadmin', NULL, NULL),
(9, 'บริษัท  โรงพยาบาลวิมุต อินเตอร์เนชั่นแนล จำกัด', 'Vimut Hospital Company International Co., Ltd', '1', 'create project owner', 'authorized', NULL, '2023-01-06 14:46:18', 'acsadmin', NULL, NULL),
(10, 'บริษัท เวชธานี จำกัด (มหาชน)', 'VEJTHANI PUBLIC COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-06 14:54:04', 'acsadmin', NULL, NULL),
(11, 'บริษัท โรงพยาบาลยันฮี จำกัด', 'Yanhee Hospital Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-06 15:03:53', 'acsadmin', NULL, NULL),
(12, 'โรงพยาบาลบางโพ', 'Bangpo General Hospital', '1', 'create project owner', 'authorized', NULL, '2023-01-06 15:45:20', 'acsadmin', NULL, NULL),
(13, 'บริษัท โรงพยาบาลกรุงเทพคริสเตียน จำกัด', 'Bangkok Christian Hospital Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-06 20:33:47', 'acsadmin', NULL, NULL),
(14, 'สำนักการแพทย์ กรุงเทพมหานคร', 'Department of Health (Bangkok Metropolitan Administration)', '1', 'create project owner', 'authorized', NULL, '2023-01-06 20:42:09', 'acsadmin', NULL, NULL),
(15, 'บริษัท กรุงเทพดุสิตเวชการ จำกัด (มหาชน)', 'BANGKOK DUSIT MEDICAL SERVICES PUBLIC COMPANY LIMITED :BDMS)', '1', 'create project owner', 'authorized', NULL, '2023-01-06 21:04:07', 'acsadmin', NULL, NULL),
(16, 'บริษัท เพชรบุรีตัดใหม่การแพทย์ จำกัด', 'New Petchburi Medical Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-07 13:58:02', 'acsadmin', NULL, NULL),
(17, 'บริษัท พิษณุโลกอินเตอร์เวชการ จำกัด', 'PHITSANULOK INTER MEDICAL CO.,LTD.', '1', 'create project owner', 'authorized', NULL, '2023-01-07 21:58:11', 'acsadmin', NULL, NULL),
(18, 'บริษัท แอดวานซ์ เมดิคอล เซนเตอร์ จำกัด', 'Advance Medical Center Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-07 22:17:32', 'acsadmin', NULL, NULL),
(19, 'โรงพยาบาลศิริราช มหาวิทยาลัยมหิดล คณะแพทย์ศาสตร์ศิริราช', 'Siriraj Hospital, Mahidol University, Faculty of Medicine ', '1', 'create project owner', 'authorized', NULL, '2023-01-12 12:40:33', 'acsadmin', NULL, NULL),
(20, 'บริษัท โรงพยาบาลพระรามเก้า จำกัด (มหาชน)', 'Praram 9 Hospital Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-12 13:04:18', 'acsadmin', NULL, NULL),
(21, 'บริษัท โรงพยาบาลกล้วยน้ำไท จำกัด', 'Kluaynamthai Hospital Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-12 13:57:17', 'acsadmin', NULL, NULL),
(22, 'คณะทันตแพทย์ศาสตร์, มหาวิทยาลัยมหิดล', 'Faculty of Dentistry, Mahidol University', '1', 'create project owner', 'authorized', NULL, '2023-01-15 09:01:17', 'acsadmin', NULL, NULL),
(23, 'แมคโนเลีย ควอลิตี้ ดีเวล็อปเม้นต์ คอร์ปอเรชั่น จำกัด', 'Magnolia Quality Development Corporation Limited. (MQDC)', '1', 'create project owner', 'authorized', NULL, '2023-01-17 08:59:15', 'acsadmin', NULL, NULL),
(24, 'บริษัท ธรรมธานี จำกัด', 'Thamma Thani Co.,Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-17 09:05:24', 'acsadmin', NULL, NULL),
(25, 'บริษัท จีพีวี เอเชีย (ประเทศไทย) จำกัด', 'GPV Asia (Thailand) Co.,Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-17 12:01:03', 'acsadmin', NULL, NULL),
(26, 'บริษัท แมรีกอท จิวเวลรี่ (ประเทศไทย) จำกัด', 'Marigot Jewelry (Thailand) Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-17 12:42:46', 'acsadmin', NULL, NULL),
(27, 'บริษัท ยูไนเต็ด แสตนดาร์ด เทร์มินัล จำกัด (มหาชน)', 'UNITED STANDARD TERMINAL PUBLIC COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-17 13:06:04', 'acsadmin', NULL, NULL),
(28, 'บริษัท ดีเอชแอล เอ๊กซ์เพรส อินเตอร์เนชั่นแนล	(ประเทศไทย) จำกัด', 'D H L EXPRESS INTERNATIONAL (THAILAND) COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-17 13:15:49', 'acsadmin', NULL, NULL),
(29, 'ห้างหุ้นส่วนจำกัด บี.เอ็น.บราเดอร์', 'B.N. BROTHERS CO.,LTD.', '1', 'create project owner', 'authorized', NULL, '2023-01-19 08:52:17', 'acsadmin', NULL, NULL),
(30, 'บริษัท จันวาณิชย์ ซีเคียวริตี้ พริ้นท์ติ้ง จำกัด', 'Chan Wanich Security Printing Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-19 09:36:07', 'acsadmin', NULL, NULL),
(31, 'บริษัท ไมเนอร์ แดรี่ จำกัด', 'MINOR DAIRY COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-19 09:47:34', 'acsadmin', NULL, NULL),
(32, 'บริษัท เอลีท คราฟท์ เปเปอร์ จำกัด', ' Elite Kraft Paper Co., Ltd', '1', 'create project owner', 'authorized', NULL, '2023-01-19 10:17:43', 'acsadmin', NULL, NULL),
(33, 'บริษัท ซี.พี. ค้าปลีกและการตลาด จำกัด', 'RETAILING AND MARKETING COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-19 10:25:06', 'acsadmin', NULL, NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `project_scope`
--

CREATE TABLE `project_scope` (
  `scope_id` int(11) NOT NULL,
  `scope_name_th` varchar(255) NOT NULL,
  `scope_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `project_scope`
--

INSERT INTO `project_scope` (`scope_id`, `scope_name_th`, `scope_name_en`, `created_at`, `updated_at`) VALUES
(1, 'ออกแบบวิศวกรรมโครงสร้าง บริหารและควบคุมงานก่อสร้าง', 'Structural engineering', '2022-08-10 15:26:03', NULL),
(2, 'ออกแบบวิศวกรรมโครงสร้าง', 'Structural engineering design', '2022-08-10 15:26:03', '2023-01-15 08:24:38'),
(3, 'ออกแบบวิศวกรรมโครงสร้าง บริหารและควบคุมงานก่อสร้าง', 'Structural engineering design. Construction management and supervision.', '2022-08-10 15:34:21', NULL),
(4, 'ควบคุมงานก่อสร้างอาคาร ตั้งแต่งานเสาเข็ม, โครงสร้าง, สถาปัตยกรรม, งานระบบต่างๆ ประสานงานการตกแต่งบาง', 'Construction management and supervision of the project', '2022-08-10 15:35:46', NULL),
(5, 'ออกแบบวิศวกรรมโครงสร้าง และควบคุมงานก่อสร้างเสาเข็ม', 'Structural engineering design and construction supervision of the piling work', '2022-08-10 15:35:46', NULL),
(6, 'บริหารและควบคุมงานก่อสร้าง', 'Construction management and supervision', '2022-10-26 23:32:44', NULL),
(7, 'ออกแบบงานโครงสร้าง  สถาปัตยกรรม และงานระบบ บริหารและควบคุมงานก่อสร้าง', 'Architectural structure design and system work. Construction management and supervision.', '2022-12-08 12:21:08', NULL),
(8, 'การออกแบบวิศวกรรมโยธา', 'civil engineering design', '2023-01-15 08:26:12', NULL),
(9, 'การออกแบบวิศวกรรมโครงสร้าง / การออกแบบวิศวกรรมโยธา', 'structural engineering design / civil engineering design', '2023-01-15 08:27:26', NULL),
(10, 'ออกแบบวิศวกรรมโครงสร้าง / ออกแบบวิศวกรรมงานระบบ / บริหารโครงการ / บริหารและควบคุมงานก่อสร้าง', 'Structural Engineering Design / System Engineering Design / Project Management /  Construction Management and Supervision', '2023-01-17 10:20:55', '2023-01-17 11:37:38'),
(11, 'ออกแบบสถาปัตยกรรม/ออกแบบวิศวกรรมโครงสร้าง 	ออกแบบวิศวกรรมงานระบบ 	บริหารและควบคุมการก่อสร้าง', 'Architectural Design/Structural Engineering Design system engineering design Construction management and supervision', '2023-01-17 15:27:29', NULL),
(12, 'ออกแบบสถาปัตยกรรมและวิศวกรรมโครงสร้าง 	ออกแบบวิศวกรรมงานระบบประกอบอาคาร', 'Architectural Design and Structural Engineering Building system engineering design', '2023-01-19 08:36:38', NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `project_status`
--

CREATE TABLE `project_status` (
  `status_id` int(11) NOT NULL,
  `status_name_th` varchar(255) NOT NULL,
  `status_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `project_status`
--

INSERT INTO `project_status` (`status_id`, `status_name_th`, `status_name_en`, `created_at`, `updated_at`) VALUES
(1, 'ยังไม่ดำเนินการ', 'pending', '2022-08-10 14:59:30', NULL),
(2, 'กำลังดำเนินการอยู่', 'inprogress ', '2022-08-10 14:59:30', NULL),
(3, 'ดำเนินการเสร็จสิ้น', 'success', '2022-08-10 14:59:42', NULL),
(4, 'ชะลอโครงการ', 'delay project', '2022-11-09 13:09:44', NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `project_type`
--

CREATE TABLE `project_type` (
  `type_id` int(11) NOT NULL,
  `type_name_th` varchar(255) NOT NULL,
  `type_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `project_type`
--

INSERT INTO `project_type` (`type_id`, `type_name_th`, `type_name_en`, `created_at`, `updated_at`) VALUES
(1, 'ผลงานออกแบบวิศวกรรมโครงสร้าง', 'Structural Engineering Design', '2022-08-10 15:07:06', NULL),
(2, 'ผลงานตรวจสอบแบบรายละเอียดและรายการคำนวณ', 'Independent Checking of Structural Design', '2022-08-10 15:07:06', NULL),
(3, 'ผลงานออกแบบแก้ไขโครงสร้าง', 'Structural Modification Design', '2022-08-10 15:10:05', NULL),
(4, 'ผลงานออกแบบทางสถาปัตยกรรม', 'Architectural Design', '2022-08-10 15:10:05', NULL),
(5, 'ผลงานบริหารและควบคุมงานก่อสร้าง', 'Construction Management and Supervision', '2022-08-10 15:10:42', NULL),
(6, 'ผลงานควบคุมงานก่อสร้างเสาเข็ม', 'Construction Supervision of Piling Works', '2022-08-10 15:10:42', NULL),
(7, 'ผลงานควบคุมงานตกแต่งภายใน', 'Construction Supervision of Interior Decoration Works', '2022-08-10 15:11:19', NULL),
(8, 'ผลงานตรวจสอบปริมาณและราคางานก่อสร้าง (Q.S.)', 'Quantity Surveying', '2022-08-10 15:11:19', NULL),
(9, 'ผลงานออกแบบวิศวกรรมระบบ', 'System Engineering Design', '2022-08-10 15:11:53', NULL),
(10, 'ผลงานตรวจสอบแบบรายละเอียดและรายการคำนวณ', 'Independent Checking of System Design', '2022-08-10 15:11:53', NULL),
(11, 'ผลงานออกแบบแก้ไขวิศวกรรมระบบ', 'System Modification Design', '2022-08-10 15:12:25', NULL),
(12, 'ผลงานที่ปรึกษาอนุรักษ์พลังงานและสิ่งแวดล้อม', 'Environmental and Energy Conservation Consultancy', '2022-08-10 15:12:25', NULL),
(13, 'ผลงานสำรวจและออกแบบแก้ไขโครงสร้าง', 'Structural Inspection and Modification Design', '2022-08-10 15:12:58', NULL),
(14, 'ผลงานสำรวจสภาพความแข็งแรงของโครงสร้าง', 'Structural Integrity Inspection', '2022-08-10 15:12:58', NULL),
(15, 'ผลงานที่ปรึกษาบริหารโครงการ', 'Project Management', '2022-08-10 15:13:34', NULL),
(16, 'ผลงานตรวจสอบแบบรายละเอียดทางสถาปัตยกรรม', 'Independent Checking of Architectural Design', '2022-08-10 15:13:34', NULL),
(17, 'ผลงานที่ปรึกษาวิศวกรรมคุณค่า (VE)', 'Value Engineering Consultancy', '2022-08-10 15:14:02', NULL),
(18, 'ผลงานศึกษาความเป็นไปได้ของโครงการ', 'Feasibility Study', '2022-08-10 15:14:02', NULL),
(19, 'ผลงานออกแบบวิศวกรรมโยธา', 'Civil Engineering Design', '2022-08-10 15:14:29', NULL),
(20, 'ผลงานออกแบบโครงสร้างพื้นฐาน', 'Infrastructure Design', '2022-08-10 15:14:29', NULL),
(21, 'ผลงานบริหารและควบคุมการก่อสร้างและออกแบบวิศวกรรมโครงสร้าง', 'Construction Management and Supervision and Structural Engineering Design', '2023-01-06 15:26:37', '2023-01-10 12:57:59'),
(22, 'ผลงานบริหารและควบคุมการก่อสร้างและออกแบบวิศวกรรมโครงสร้าง /โยธา	', 'Construction Management and Supervision and Structural/Civil Engineering Design', '2023-01-10 12:56:30', '2023-01-10 12:58:47'),
(23, 'ผลงานออกแบบวิศวกรรมโครงสร้าง / ออกแบบวิศวกรรมงานระบบ / บริหารโครงการ / บริหารและควบคุมงานก่อสร้าง', 'Structural Engineering Design / System Engineering Design / Project Management / Construction Management and Supervision', '2023-01-17 11:40:23', '2023-01-17 15:30:24'),
(24, 'ผลงานออกแบบสถาปัตยกรรม/ออกแบบวิศวกรรมโครงสร้าง 	 ออกแบบวิศวกรรมงานระบบ 	บริหารและควบคุมการก่อสร้าง', 'Portfolio Architectural design/Structural engineering design system engineering design Construction management and supervision', '2023-01-17 15:28:26', NULL),
(25, 'ผลงานออกแบบสถาปัตยกรรมและวิศวกรรมโครงสร้าง ออกแบบวิศวกรรมงานระบบประกอบอาคาร', 'Architectural design and structural engineering works Building system engineering design', '2023-01-19 08:37:40', NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `template`
--

CREATE TABLE `template` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `template_language` enum('TH','EN') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `template_detail`
--

CREATE TABLE `template_detail` (
  `tdetail_id` int(11) NOT NULL,
  `tdetail_template_id` int(11) NOT NULL,
  `tdetail_project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_mobilenumber` varchar(20) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `user_depid` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `user_email`, `user_firstname`, `user_lastname`, `user_mobilenumber`, `user_role`, `user_depid`, `created_at`, `updated_at`) VALUES
(1, 'acsadmin', '$2y$10$6xRUNFqz8pUVHRWz32aFC.u8LyvOJq5Q29f5c/RcLBPj08RSG5Bw2', 'acs@arunchaiseri.co.th', 'ACS', 'Admin', '1234', 'admin', '5', '2022-09-15 05:41:32', '2022-12-20 14:42:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`pcategory_id`);

--
-- Indexes for table `project_owner`
--
ALTER TABLE `project_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `project_scope`
--
ALTER TABLE `project_scope`
  ADD PRIMARY KEY (`scope_id`);

--
-- Indexes for table `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `template_detail`
--
ALTER TABLE `template_detail`
  ADD PRIMARY KEY (`tdetail_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `pcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_owner`
--
ALTER TABLE `project_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `project_scope`
--
ALTER TABLE `project_scope`
  MODIFY `scope_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `project_status`
--
ALTER TABLE `project_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template_detail`
--
ALTER TABLE `template_detail`
  MODIFY `tdetail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
