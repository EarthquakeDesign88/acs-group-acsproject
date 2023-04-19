-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 04:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_desc` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_desc`, `created_at`, `updated_at`) VALUES
(1, 'AR', 'ฝ่ายออกแบบสถาปัตยกรรม', '2022-08-10 15:04:19', '2023-01-09 23:46:01'),
(2, 'CM', 'ฝ่ายบริหารและควบคุมงานก่อสร้าง', '2022-08-10 15:04:19', NULL),
(3, 'INFRA', 'ฝ่ายออกแบบวิศวกรรมโยธา', '2022-08-10 15:04:40', NULL),
(4, 'ME&E', 'ฝ่ายออกแบบระบบวิศวกรรมประกอบอาคาร', '2022-08-10 15:04:40', '2023-01-22 11:55:19'),
(5, 'OTHERS', 'อื่นๆ', '2022-08-10 15:05:02', NULL),
(6, 'PM', 'ฝ่ายบริหารโครงการและต้นทุน', '2022-08-10 15:05:02', '2023-01-22 12:05:41'),
(7, 'R&D', 'ฝ่ายวิจัยและพัฒนา', '2022-08-10 15:05:24', NULL),
(8, 'SD', 'ฝ่ายออกแบบวิศวกรรมโครงสร้าง', '2022-08-10 15:05:24', NULL),
(9, 'CM / SD', 'ฝ่ายบริหารและควบคุมงานก่อสร้าง / ฝ่ายออกแบบวิศวกรรมโครงสร้าง', '2023-01-06 15:32:21', '2023-01-06 15:32:42'),
(10, 'AR / SD / ME&E / CM', 'ออกแบบสถาปัตยกรรมและวิศวกรรมโครงสร้าง 	ออกแบบระบบวิศวกรรมประกอบอาคาร , บริหารและควบคุมงานก่อสร้าง', '2023-01-19 09:57:15', '2023-01-26 15:28:58'),
(11, 'SD / ME&E / CM', 'ออกแบบวิศวกรรมโครงสร้าง และ งานออกแบบระบบวิศวกรรมประกอบอาคาร /  บริหารและควบคุมงานก่อสร้าง', '2023-01-20 16:16:13', '2023-01-22 12:05:04'),
(12, 'CM / PM /SD', 'ฝ่ายบริหารและควบคุมงานก่อสร้าง / ฝ่ายบริหารโครงการและต้นทุน / ฝ่ายออกแบบวิศวกรรมโครงสร้าง', '2023-01-20 18:51:54', '2023-01-24 07:40:15'),
(13, 'PM / AR /SD / INFRA / ME&E', 'ที่ปรึกษาควบคุมต้นทุน ออกแบบสถาปัตยกรรม /วิศวกรรมโครงสร้าง / โยธาและระบบวิศวกรรมประกอบอาคาร', '2023-01-20 19:38:06', '2023-01-22 12:04:09'),
(15, 'CM / SD / InFra', 'บริหารและควบคุมงานก่อสร้าง / ออกแบบวิศวกรรมโครงสร้าง / โยธา', '2023-01-24 14:03:08', '2023-01-26 15:29:22'),
(16, 'AR / SD / ME&E / PM / CM', 'ออกแบบสถาปัตยกรรม /วิศวกรรมโครงสร้าง /งานระบบประกอบอาคาร/บริหารโครงการ/บริหารและควบคุมงานก่อสร้าง', '2023-01-25 09:04:39', NULL),
(17, 'PM / CM', 'ฝ่ายบริหารโครงการและต้นทุน/ฝ่ายบริหารและควบคุมงานก่อสร้าง', '2023-01-25 16:24:03', NULL),
(18, 'CM / PM / SD / ME&E', 'ฝ่ายบริหารและควบคุมงานก่อสร้าง/บริหารโครงการและต้นทุน/ออกแบบวิศวกรรมโครงสร้าง /ออกแบบวิศวกรรมงานระบบ', '2023-02-19 15:33:05', '2023-02-19 15:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `project`
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
  `project_image` text DEFAULT NULL,
  `project_year_of_commencement` varchar(50) NOT NULL,
  `project_year_of_completion` varchar(50) NOT NULL,
  `project_active` enum('1','0') NOT NULL DEFAULT '0',
  `project_action` varchar(50) NOT NULL,
  `project_reviewstatus` varchar(50) DEFAULT NULL,
  `project_remarkstatus` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project`
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
(60, 'โครงการส่วนขยาย บจก. ซี.พี. ค้าปลีก และการตลาด นิคมอุตสาหกรรมลาดกระบัง', 'Expansion Project C.P. Retail Co., Ltd. and marketing Lat Krabang Industrial Estate', 1, 'นิคมอุตสาหกรรมลาดกระบัง กรุงเทพ\r\n', 'Ladkrabang Industrial Estate, Bangkok', 33, 6, 5, 2, 3, 28, 2500, 'โครงการก่อสร้างส่วนขยายประกอบด้วย อาคาร โรงงาน (โกดัง) ใช้เป็นโรงเก็บสินค้าและรับสินค้า 	บางส่วนใช้เป็นห้องเย็น ห้องอาหารและห้องประชุม\r\n\r\n', 'The expansion construction project consists of a factory building (warehouse) used as a warehouse and receiving goods. Some are used as cold rooms. Restaurant and meeting room', '[\"expansion project c.p. retail co., ltd. and marketing lat krabang industrial estate-63c8b8e713274.jpg\"]', '0', '2548', '1', 'upload image', 'authorized', NULL, '2023-01-19 10:28:08', 'acsadmin', '2023-01-19 10:28:39', 'acsadmin'),
(61, 'ดีเอชแอล สุวรรณภูมิ เซอร์วิส เซนเตอร์', 'DHL Suvarnabhumi Service Center', 1, 'ถนนบางนา-ตราด จ.สมุทรปราการ', 'Bangna-Trad Road Samut Prakan Province', 28, 11, 24, 10, 3, 11, 2172, 'อาคารคลังสินค้าและศูนย์บริการลูกค้า\r\n', 'Warehouse building and customer service center', '[\"dhl suvarnabhumi service center-63ca5b395c106.jpg\"]', '0', '2549', '1', 'upload image', 'authorized', NULL, '2023-01-20 16:12:54', 'acsadmin', '2023-01-20 16:13:29', 'acsadmin'),
(62, 'โครงการปรับปรุงอาคารคลังสินค้าและศูนย์บริการลูกค้า ถนนพระราม 3', 'Warehouse and Customer Service Center Improvement Project on Rama 3 Road', 1, 'ถนนพระราม 3 กรุงเทพมหานคร\r\n', 'Rama 3 Road, Bangkok', 28, 13, 26, 11, 3, 17, 3248, 'อาคารคลังสินค้าสูง 1 ชั้น (และชั้นลอย) และศูนย์บริการลูกค้าสูง 1 ชั้น\r\n', '1 storey warehouse building (and mezzanine)\r\nand a 1-storey customer service center', '[\"warehouse and customer service center improvement project on rama 3 road-63ca5e9084591.jpg\"]', '0', '2546', '1', 'upload image', 'authorized', NULL, '2023-01-20 16:26:46', 'acsadmin', '2023-01-20 16:27:44', 'acsadmin'),
(63, 'SUS Cold Rolling Mill Complex', 'SUS Cold Rolling Mill Complex', 1, 'อำเภอเมือง จังหวัดระยอง\r\n', 'Muang District, Rayong Province', 34, 13, 26, 11, 3, 400, 60000, 'อาคารสำนักงาน คลังสินค้าและคลังวัตถุดิบ\r\n\r\n', 'office building warehouse and raw material warehouse', '[\"sus cold rolling mill complex-63ca73e08c533.jpeg\"]', '0', '2541', '1', 'upload new image', 'authorized', NULL, '2023-01-20 17:27:40', 'acsadmin', '2023-01-20 17:58:40', 'acsadmin'),
(64, 'โรงแรม จัสมิน ทองหล่อ เรสซิเดนส์  ', 'Jasmine Thonglor Residence', 2, 'ซอยสุขุมวิท 59  ถนนสุขุมวิท กรุงเทพฯ\r\n', 'Sukhumvit 59, Bangkok', 35, 6, 5, 2, 3, 1000, 34000, 'ประกอบด้วยอาคารโรงแรมสูง 30 ชั้น จำนวน 1 อาคาร\r\n', 'Hotel 30 Storey', '[\"jasmine thonglor residence-63ca6f99137be.jpg\",\"jasmine thonglor residence-63ca6f9913baf.jpg\"]', '0', '2561', '1', 'upload image', 'authorized', NULL, '2023-01-20 17:39:24', 'acsadmin', '2023-01-20 17:40:25', 'acsadmin'),
(65, 'ระยอง  แมริออท รีสอร์ท แอนด์ สปา', 'Rayong Marriott Resort & Spa', 2, 'อำเภอแกลง จังหวัดระยอง\r\n', 'Klaeng District, Rayong Province', 36, 14, 27, 12, 3, 1400, 37069, 'โครงการประกอบด้วยอาคารโรงแรมสูง 12 ชั้น อาคารสปา ร้านอาหาร Villa สระว่ายน้ำ\r\nพร้อมสิ่งอำนวยความสะดวกต่าง ๆ \r\n', 'The project consists of a 12-storey hotel building.\r\nSpa building, restaurant, villa, swimming pool\r\nwith various facilities', '[\"rayong marriott resort & spa-63ca81e19d19e.jpg\"]', '0', '2556', '1', 'upload image', 'authorized', NULL, '2023-01-20 18:58:06', 'acsadmin', '2023-01-20 18:58:25', 'acsadmin'),
(66, 'โรงแรมฮอลิเดย์ อินน์ ไม้ขาว บีช ', 'Holiday Inn Mai Khao Beach', 2, 'อำเภอถลาง จังหวัดภูเก็ต\r\n', 'Thalang District, Phuket Province', 37, 6, 5, 2, 3, 680, 17500, 'โรงแรมระดับ 4 ดาว ห้องพักประมาณ 240 ห้อง 	อาคารส่วนต้อนรับ สำนักงาน ภัตตาคาร ห้องประชุม ห้องจัดเลี้ยง ร้านค้า คลับเฮ้าส์ งานภูมิทัศน์ และ ระบบสาธารณูปโภค \r\n', '4-star hotel, approximately 240 rooms, reception building, office, restaurant, meeting roomBanquet rooms, shops, clubhouses, landscape works and\r\nUtilities', '[\"holiday inn mai khao beach-63ca83f1bd401.jpg\"]', '0', '2564', '1', 'upload image', 'authorized', NULL, '2023-01-20 19:06:57', 'acsadmin', '2023-01-20 19:07:13', 'acsadmin'),
(67, 'โรงแรม ออล ซีซั่น ภูเก็ต รีสอร์ท ', 'Hotel All Seasons Phuket Resort', 2, 'อำเภอป่าตอง จังหวัดภูเก็ต\r\n', 'Patong District, Phuket Province', 38, 15, 28, 13, 3, 500, 9900, 'โรงแรมขนาด 3 ดาว มีสูง 4 ชั้น (ใต้ดิน 1 ชั้น) จำนวน 4 อาคาร และอาคารสูง 6 ชั้น \r\n(U-shape) 	จำนวน 1 อาคาร มีห้องพัก 256 ห้อง\r\n', 'A 3-star hotel with 4 floors (1 underground floor), 4 buildings and 6-storey buildings (U-shape), 1 building with 256 rooms.', '[\"hotel all seasons phuket resort-63ca9097c9f25.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-01-20 20:00:03', 'acsadmin', '2023-01-20 20:01:11', 'acsadmin'),
(68, 'All Season Hotel ถนนพหลโยธิน  ', 'All Season Hotel Phaholyothin Road', 2, 'ซอยพหลโยธิน 3 ถนนพหลโยธิน เขตพญาไท  กรุงเทพมหานคร', 'Soi Phahon Yothin 3, Phahon Yothin Road, Phaya Thai District, Bangkok', 39, 6, 5, 2, 3, 500, 9900, 'อาคารโรงแรมสูง 7 ชั้น ชั้นใต้ดิน 2 ชั้น จำนวน	ห้องพัก 162 ห้อง\r\n', 'Hotel building with 7 floors, 2 basement floors, 162 rooms', '[\"all season hotel phaholyothin road-63ca96fd11b31.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-01-20 20:28:14', 'acsadmin', '2023-01-20 20:28:29', 'acsadmin'),
(69, 'Hilton Hotel @ Central Festival ', 'Hilton Hotel @ Central Festival ', 2, 'อำเภอเมือง พัทยา จังหวัดชลบุรี\r\n', 'Muang District, Pattaya, Chonburi Province', 40, 6, 5, 2, 3, 2000, 31500, 'อาคารโรงแรมสูง 27 ชั้น มีห้องพัก 300 ห้อง\r\n', 'The 27-storey hotel has 300 rooms.', '[\"hilton hotel @ central festival -63ca983eb7ad8.jpg\"]', '0', '2556', '1', 'upload image', 'authorized', NULL, '2023-01-20 20:33:26', 'acsadmin', '2023-01-20 20:33:50', 'acsadmin'),
(70, 'ศิวยาธร ทาวน์เวอร์  ', 'Siwayathorn Tower', 2, 'ถนนวิทยุ  กรุงเทพมหานคร\r\n', 'Thanon Witthayu  Bongkok', 41, 14, 27, 12, 3, 1100, 30000, 'โรงแรมขนาด 323 ห้อง มีความสูง 32 ชั้น จำนวน 1 อาคาร\r\n', 'The hotel has 323 rooms, 32 floors, 1 building.', '[\"siwayathorn tower-63ca99c7d6e01.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-01-20 20:39:57', 'acsadmin', '2023-01-20 20:40:23', 'acsadmin'),
(71, 'จัสมิน รีสอร์ท โฮเต็ล', 'Jasmine Resort and Park Hotel ', 2, 'ถนนสุขุมวิท 69  กรุงเทพมหานคร\r\n', 'Sukhumvit 69 Road, Bangkok', 42, 6, 5, 2, 3, 529, 30025, 'อาคารสูง 27 ชั้น และชั้นใต้ดิน 1 ชั้น ประกอบด้วยโรงแรม พื้นที่ให้เช่า รวม 300 ห้อง \r\nและที่จอดรถ	จำนวน 170 คัน\r\n', '27-storey building with 1 basement floor\r\nConsists of a hotel Leasable area totaling 300 rooms\r\nand parking for 170 cars', '[\"jasmine resort and park hotel -63ca9b63a1e7f.jpg\"]', '0', '2553', '1', 'upload new image', 'authorized', NULL, '2023-01-20 20:46:07', 'acsadmin', '2023-01-20 20:47:15', 'acsadmin'),
(72, 'เดอะ รอยัลมณียา ทาวเวอร์ (โรงแรมเรอเนสซองซ์)  ', 'The Royal Maneeya Tower (Renaissance Hotel)', 2, 'ถนนเพลินจิต กรุงเทพมหานคร\r\n', 'Ploenchit Road, Bangkok', 43, 6, 5, 2, 3, 2200, 60000, 'โรงแรมห้องพัก 333 ห้องอยู่ตรงกลางและด้านล่างเป็นส่วนพักอาศัย 66 ห้องอยู่ด้านบนเป็นอาคารสูง 35 ชั้น	และชั้นใต้ดินลึก 5 ชั้น\r\n', 'The 333-room hotel is in the middle and below is the 66-room residential area on the top, a 35-storey building with a 5-storey deep basement.', '[\"the royal maneeya tower (renaissance hotel)-63ca9cbc6e9bb.jpeg\",\"the royal maneeya tower (renaissance hotel)-63ca9cbc70031.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-20 20:50:52', 'acsadmin', '2023-01-20 20:53:00', 'acsadmin'),
(73, 'Amatapura Krabi Villas & Spa', 'Amatapura Krabi Villas & Spa', 2, 'อำเภอเมือง  จังหวัดกระบี่\r\n', 'Muang District, Krabi Province', 40, 14, 27, 12, 3, 315, 36500, 'วิลล่าตากอากาศริมหาด ประกอบด้วย Beach Villas (Raja) Beach Villas (Suriyan) \r\nSemi-detached สปาและสระว่ายน้ำ\r\n', 'Beach villas include Beach Villas (Raja), Beach Villas (Suriyan).\r\nSemi-detached spa and swimming pool', '[\"amatapura krabi villas & spa-63ca9e2adf331.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-20 20:57:09', 'acsadmin', '2023-01-20 20:59:06', 'acsadmin'),
(74, 'ฮอลิเดย์ อินน์ พัทยา', 'Holiday Inn Pattaya  ', 2, 'พัทยาเหนือ จังหวัดชลบุรี\r\n', 'North Pattaya, Chonburi Province', 44, 3, 21, 9, 3, 1100, 30000, 'อาคารโรงแรมสูง 26 ชั้น มีชั้นใต้ดิน 1 ชั้น 	ห้องพัก จำนวน 367 ห้อง\r\n', '26-storey hotel building with 1 basement floor, 367 rooms', '[\"holiday inn pattaya  -63caa0a5ace97.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-20 21:09:18', 'acsadmin', '2023-01-20 21:09:41', 'acsadmin'),
(75, 'เรดิสัน บลู พลาซ่า รีสอร์ท ภูเก็ต พันวา บีช', 'Radisson Plaza Resort Phuket  ', 2, 'ถ.บ้านอ่าวมะขาม – แหลมพันวา จ.ภูเก็ต\r\n', 'Ban Ao Makham Road - Cape Panwa, Phuket Province', 45, 13, 26, 11, 3, 1100, 20592, 'โรงแรมและบ้านพักตากอากาศประกอบด้วย	อาคารที่พัก สปา สระว่ายน้ำ ห้องอาหาร \r\nห้องประชุม สำนักงาน ร้านค้า ฟิตเนส\r\n', 'Hotels and vacation homes consist of residential buildings, spas, swimming pools, and restaurants.\r\nMeeting rooms, offices, shops, fitness centers', '[\"radisson plaza resort phuket  -63caa23e3784b.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-20 21:16:05', 'acsadmin', '2023-01-20 21:16:30', 'acsadmin'),
(76, ' เลอ เมอริเดียน เชียงราย รีสอร์ท', 'Le Meridien Chiangrai  ', 2, '221 / 2 หมู่ 20 ถนนแควหวาย, ตำบลรอบเวียง, อำเภอเมือง, จังหวัดเชียงราย\r\n', '221 / 2 Moo 20, Khwae Wai Road, Rob Wiang Subdistrict, Mueang District, Chiang Rai Province', 46, 16, 15, 6, 3, 800, 24000, 'โครงการประกอบด้วยห้องพักจำนวน 160 ห้อง 	ห้องประชุม-สัมมนา ร้านค้า ร้านสปา \r\nห้องออกกำลังกายและสระว่ายน้ำภายนอก\r\n', 'The project consists of 160 guest rooms, meeting rooms - seminars, shops, spa shops, a gym and an outdoor swimming pool.', '[\"le meridien chiangrai  -63caa87e47ae9.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-01-20 21:42:27', 'acsadmin', '2023-01-20 21:43:10', 'acsadmin'),
(77, 'Alila Hotels and Resort   ', 'Alila Hotels and Resort   ', 2, 'อำเภอชะอำ  จังหวัดเพชรบุรี\r\n', 'Cha-Am District, Phetchaburi', 47, 6, 5, 2, 3, 222, 14600, 'โรงแรม 1 หลัง และบ้านพักตากอากาศ 10 หลัง 	โครงการประกอบด้วยงานก่อสร้างกลุ่มอาคารได้แก่ อาคาร Central Building และอาคารส่วน ห้องพัก จำนวน 65 ห้อง\r\n', '1 hotel and 10 villas. The project consists of the construction of a group of buildings, namely the Central Building and the 65-room building.', '[\"alila hotels and resort   -63caabc5c1be7.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-01-20 21:56:51', 'acsadmin', '2023-01-20 21:57:09', 'acsadmin'),
(78, 'โรงแรม รวิวาริน รีสอร์ท แอนด์ สปา  อาคารภัตตาคารและสัมมนา  ', 'Rawi Warin Resort and Spa Hotel, Restaurant and Seminar Buildi', 2, 'บนทางหลวงแผ่นดินหมายเลข 4245 	ระหว่างกิโลเมตรที่ 12+110 และกิโลเมตรที่ 	12+380 เลขที่ตั้ง 139 หมู่ที่ 8 บ้านคลองโตบ ตำบลเกาะลันตา อำเภอเกาะลันตา จังหวัดกระบี่\r\n', 'on National Highway No. 4245 between km. 12+110 and km. 12+380, location number 139, Moo 8, Ban Khlong Tob\r\nKoh Lanta Subdistrict Koh Lanta District Krabi Province', 48, 6, 5, 2, 3, 385, 23655, 'อาคารชั้นเดียว จำนวน 43 หลัง อาคารสองชั้นจำนวน 10 หลัง \r\nและอาคารสามชั้นจำนวน 11 หลัง รวมเป้นอาคารทั้งหมด 64 อาคาร', '43 one-story buildings, 10 two-story buildings\r\nand 11 three-story buildings, totaling 64 buildings.', '[\"rawi warin resort and spa hotel, restaurant and seminar buildi-63cab0349c316.jpg\"]', '0', '2548', '1', 'upload image', 'authorized', NULL, '2023-01-20 22:15:15', 'acsadmin', '2023-01-20 22:16:04', 'acsadmin'),
(79, 'พัทยา มาริออท รีสอร์ท แอนด์ สปา ,  รอยัล การ์เด้น รีสอร์ท (เฟท 2)  ', 'Pattaya Marriott Resort & Spa , Royal Garden Resort (Fate 2)', 2, 'อำเภอบางละมุง  จังหวัดชลบุรี', 'Bang Lamung District Chonburi Province', 50, 6, 6, 2, 3, 400, 32382, 'อาคารที่พัก Phase 2 สูง 10 ชั้น ชั้นใต้ดิน 1 ชั้น 	จำนวน 1 อาคาร\r\n', 'Phase 2 residential building, 10 floors high, 1 basement floor, 1 building', '[\"pattaya marriott resort & spa , royal garden resort (fate 2)-63cf26549a893.jpg\"]', '0', '2533', '1', 'upload image', 'authorized', NULL, '2023-01-24 07:28:15', 'acsadmin', '2023-01-24 07:29:08', 'acsadmin'),
(80, 'รอยัล พาราไดซ์ คอมเพล็กซ์', 'Royal Paradise Complex', 2, '135/23 พาราไดซ์ คอมเพล็กซ์ อ.กะทู้, ป่าตอง, ภูเก็ต,  83150', '135/23 Paradise Complex, Kathu, Patong, Phuket 83150', 51, 3, 21, 12, 3, 500, 70000, 'อาคารโรงแรมสูง 22 ชั้น โครงสร้างใช้ระบบพื้นคาน	คอนกรีตเสริมเหล็ก \r\n', 'A 22-storey hotel building, the structure uses a beam floor system. reinforced concrete', '[\"royal paradise complex-63cf283e67c14.jpg\"]', '0', '2532', '1', 'update project', 'authorized', NULL, '2023-01-24 07:36:37', 'acsadmin', '2023-01-26 13:49:28', 'acsadmin');
INSERT INTO `project` (`project_id`, `project_name_th`, `project_name_en`, `project_category`, `project_location_th`, `project_location_en`, `project_owner`, `project_scope`, `project_type`, `project_department`, `project_status`, `project_value`, `project_area`, `project_description_th`, `project_description_en`, `project_image`, `project_year_of_commencement`, `project_year_of_completion`, `project_active`, `project_action`, `project_reviewstatus`, `project_remarkstatus`, `created_at`, `user_created`, `updated_at`, `user_updated`) VALUES
(81, 'อาคารรัฐสภาแห่งใหม่ สัปปายะสภาสถาน', 'new parliament building Sappayasaphasathan', 3, 'ถนนทหาร(เกียกกาย)  เขตดุสิต  กรุงเทพฯ\r\n', 'Thahan Road (Kiakkai), Dusit District, Bangkok', 52, 6, 5, 2, 3, 12280, 424000, 'ประกอบด้วยอาคาร รัฐสภา สูง 11 ชั้น และชั้นใต้ดินสูง 2 ชั้น, อาคารสถานีวิทยุและโทรทัศน์	รัฐสภาสูง 4 ชั้น, อาคารลานประชาชน, อาคารหอพระ อาคารทางเข้าจากท่าเรือ, อาคารเรือนเพาะชำ เป็นต้น\r\n', 'It consists of the 11-storey parliament building.\r\nand a 2-storey basement, a 4-storey parliament radio and television station building, a public square building, a hor-phra building, an entrance building from the pier, a nursery building, etc.', '[\"new parliament building sappayasaphasathan-63cf2f7ab5571.jpg\",\"new parliament building sappayasaphasathan-63cf2f7ab57f0.jpg\",\"new parliament building sappayasaphasathan-63cf2f7ab5976.jpg\",\"new parliament building sappayasaphasathan-63cf2f7ab5bf2.jpg\",\"new parliament building sappayasaphasathan-63cf2f7ab5e08.jpg\",\"new parliament building sappayasaphasathan-63cf2f7ab6177.jpg\",\"new parliament building sappayasaphasathan-63cf2f7ab6562.jpg\",\"new parliament building sappayasaphasathan-63cf2f7ab6976.jpg\"]', '2556', '2564', '1', 'upload new image', 'authorized', NULL, '2023-01-24 08:02:36', 'acsadmin', '2023-01-24 08:08:10', 'acsadmin'),
(82, 'อาคารสำนักงาน ธนบุรีพานิช ', 'Thonburi Panich office building', 3, 'ถนนจรัญสนิทวงศ์ บางพลัด กรุงเทพมหานคร\r\n', 'Charansanitwong Road, Bang Phlat, Bangkok', 53, 17, 5, 2, 3, 724, 29815, 'ประกอบด้วย อาคารสำนักงานสูง 17 ชั้น จำนวน 1 อาคาร, สูง 8 ชั้น จำนวน 1 อาคาร\r\n', 'Consists of a 17-storey office building, 1 building, 8-storey building, 1 building', '[\"thonburi panich office building-63cf43768894a.jpg\"]', '0', '2563', '1', 'upload image', 'authorized', NULL, '2023-01-24 09:32:54', 'acsadmin', '2023-01-24 09:33:26', 'acsadmin'),
(83, 'สถานเอกอัครราชทูตไทย ณ กรุงนิวเดลี  สาธารณรัฐอินเดีย ', ' Royal Thai Embassy in New Delhi', 3, 'ณ กรุงนิวเดลี  สาธารณรัฐอินเดีย', 'in New Delhi, Republic of India', 54, 6, 5, 2, 3, 500, 55000, 'อาคารที่ทำการสูง 3 ชั้น /ชั้นใต้ดิน 1 ชั้น  1 อาคาร และอาคารสถานีไฟฟ้าย่อย  1 อาคาร\r\n', '3-storey office building / 1-storey basement, 1 building and 1 power substation building', '[\" royal thai embassy in new delhi-63cf452f5daa0.jpg\"]', '0', '2561', '1', 'upload image', 'authorized', NULL, '2023-01-24 09:40:23', 'acsadmin', '2023-01-24 09:40:47', 'acsadmin'),
(84, 'อาคารเรียนอเนกประสงค์  มหาวิทยาลัยแม่ฟ้าหลวง ', 'multi-purpose building Mae Fah Luang University', 3, ' ตำบลท่าสุด  อำเภอเมือง จังหวัดเชียงราย\r\n', 'Thasud Subdistrict, Mueang District, Chiang Rai Province', 5, 6, 5, 2, 3, 745, 55000, 'ประกอบด้วย อาคารเรียนอเนกประสงค์ พร้อมระบบสาธารณูปการ ที่ทำการสำนักวิชา และ	ที่จอดรถ สูง 9 ชั้น  \r\n', 'It consists of a multi-purpose school building with public facilities. Academic office and 9-storey car park', '[\"multi-purpose building mae fah luang university-63cf46679fcb2.jpg\"]', '0', '2561', '1', 'upload image', 'authorized', NULL, '2023-01-24 09:45:39', 'acsadmin', '2023-01-24 09:45:59', 'acsadmin'),
(85, 'อาคารสำนักงาน บริษัท โอสถสภา จำกัด', 'Osotspa Public Company Limited', 3, ' ถนนรามคำแหง เขตบางกะปิ กรุงเทพฯ\r\n', 'Ramkhamhaeng Road, Bang Kapi District, Bangkok', 55, 6, 5, 2, 3, 658, 29641, 'ประกอบด้วยอาคารสำนักงานสูง 13 ชั้น 1 อาคาร และ อาคารสำนักงานและที่จอดรถสูง 9 ชั้น 1 อาคาร\r\n', 'Consists of a 13-storey office building and an office building and a 9-storey car park', '[\"osotspa public company limited-63cf51aecfa14.jpg\"]', '0', '2559', '1', 'upload image', 'authorized', NULL, '2023-01-24 10:33:44', 'acsadmin', '2023-01-24 10:34:06', 'acsadmin'),
(86, 'ปรับปรุงอาคารแจ้งวัฒนะ 2 ธนาคารกสิกรไทย', 'Renovation of Chaengwattana 2 Building, Kasikorn Bank', 3, ' ป๊อปปูล่า ต.บ้านใหม่ อ. ปากเกร็ด จ.นนทบุรี', 'Popular, Ban Mai Subdistrict, Pak Kret District, Nonthaburi Province', 56, 17, 5, 2, 3, 1800, 7800, 'ปรับปรุงอาคารสำนักงานสูง 11 ชั้น 1 อาคาร\r\n\r\n', 'Renovation of one 11-storey office building', '[\"renovation of chaengwattana 2 building, kasikorn bank-63cf54f8b82db.jpg\"]', '0', '2563', '1', 'upload image', 'authorized', NULL, '2023-01-24 10:47:43', 'acsadmin', '2023-01-24 10:48:08', 'acsadmin'),
(88, 'อาคารศูนย์เทคโนโลยีสารสนเทศ กรมสรรพสามิต', 'Information Technology Center Excise Department', 3, 'ถนนนครไชยศรี เขตดุสิต กรุงเทมหานคร\r\n', 'Nakhon Chai Si Road, Dusit District, Bangkok', 57, 6, 24, 10, 3, 345, 4860, 'อาคารศูนย์สารสนเทศและสำนักงาน สูง 5 ชั้น และ ชั้นใต้ดิน 1 ชั้น\r\n', 'Information center and office building, 5 floors and 1 basement floor', '[\"information technology center excise department-63cf5903e1783.jpg\"]', '0', '2556', '1', 'upload image', 'authorized', NULL, '2023-01-24 11:05:06', 'acsadmin', '2023-01-24 11:05:23', 'acsadmin'),
(89, 'ศาลาว่าการกรุงเทพมหานคร 2 (ดินแดง)', ' Bangkok Metropolitan Administration 2 (Din Daeng)', 3, 'ถนนมิตรไมตรี เขตดินแดง กรุงเทพมหานคร 10400', 'Mitmaitri Road, Dindaeng, Bangkok 10400.', 58, 1, 21, 9, 3, 3500, 358600, 'อาคารสำนักงานสูง 27 ชั้น จำนวน 2 หลัง สูง 37 ชั้น 	จำนวน 1 หลังและชั้นใต้ดิน 1 หลัง เชื่อมต่อกัน	ด้วยอาคาร Podium สูง 5 ชั้น\r\n', 'Two 27-storey office buildings, one 37-storey building and one basement are connected by a 5-storey Podium building.', '[\" bangkok metropolitan administration 2 (din daeng)-63f33bc827a58.jpg\"]', '0', '2554', '1', 'upload new image', 'authorized', NULL, '2023-01-24 11:16:40', 'acsadmin', '2023-02-20 16:22:16', 'acsadmin'),
(90, 'อาคารสำนักงานใหญ่ องค์การกระจายเสียงและแพร่ภาพสาธารณะ แห่งประเทศ', '(Thai PBS) THAI PUBLIC BROADCASTING SERVICE ', 3, 'ถนนวิภาวดีรังสิต กรุงเทพมหานคร\r\n', 'Vibhavadi Rangsit Road Bangkok', 59, 18, 22, 15, 3, 1726, 3700, 'อาคารสำนักงานสูง 6 ชั้น ประกอบด้วยอาคารปฎิบัติการ อาคารสาธารณะและอาคารจอดรถ\r\n', '6-storey office building consisting of a building\r\nOperating public buildings and parking buildings', '[\"(thai pbs) thai public broadcasting service -63cf8380098a9.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-01-24 14:05:38', 'acsadmin', '2023-01-24 14:06:40', 'acsadmin'),
(91, 'อาคารเอนกประสงค์และที่จอดรถ ในโครงการนอร์ธปาร์ค', 'multipurpose building and parking lot in the North Park project', 3, 'โครงการนอร์ธปาร์ต ถนนวิภาวดีรังสิต กรุงเทพฯ', 'North Part Project Vibhavadi Rangsit Road, Bangkok', 60, 6, 5, 2, 3, 176, 4800, 'อาคารเอนกประสงค์สูง 4 ชั้น จำนวน 1 อาคาร ลานจอดรถจำนวน 240 คัน\r\n', 'Multi-purpose building, 4 floors, 1 building Parking lot 240 cars', '[\"multipurpose building and parking lot in the north park project-63cf8556005f5.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-24 14:12:49', 'acsadmin', '2023-01-24 14:14:29', 'acsadmin'),
(92, 'อาคารจอดรถตลาดแห่งประเทศไทย  ถนนรัชดาภิเษก', 'Thailand market parking building Ratchadapisek Road', 3, 'ถนนรัชดาภิเษก  กรุงเทพมหานคร ', 'Ratchadapisek Road Bangkok', 60, 19, 24, 16, 3, 250, 23000, 'อาคารจอดรถสูง 9 ชั้น\r\n', '9-storey car park building', '[\"thailand market parking building ratchadapisek road-63d08fe651387.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-25 09:11:22', 'acsadmin', '2023-01-25 09:11:50', 'acsadmin'),
(93, 'ปรับปรุงอาคารธนาคารกสิกรไทย ถนนพหลโยธิน', 'Renovation of the Kasikorn Bank building', 3, 'ถนนพหลโยธิน   กรุงเทพมหานคร\r\n', 'Phaholyothin Road, Bangkok', 56, 6, 5, 2, 3, 233, 34675, 'อาคารมีความสูง 19 ชั้น โดยเป็นการปรับปรุง\r\n', 'The building has a height of 19 floors as a renovation.', '[\"renovation of the kasikorn bank building-63d0928a77660.jpg\",\"renovation of the kasikorn bank building-63d0928a77b6a.jpg\",\"renovation of the kasikorn bank building-63d0928a77ce7.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-01-25 09:18:52', 'acsadmin', '2023-01-25 09:23:06', 'acsadmin'),
(94, 'อาคารแจ้งวัฒนะ (อาคารสำนักงานธนาคารกสิกรไทย No.3)', 'Chaengwattana Building (Kasikorn Bank Office Building No.3)', 3, 'ถนนแจ้งวัฒนะ  จังหวัดนนทบุรี', 'Chaengwattana Road, Nonthaburi Province', 56, 13, 26, 11, 3, 2255, 66755, 'เป็นการปรับปรุงอาคารสำนักงาน มีที่จอดรถใน	อาคาร 360 คันและลานจอดรถนอกอาคาร 174 คัน\r\n', 'It is an office building renovation with 360 indoor parking spaces and 174 outdoor parking spaces.', '[\"chaengwattana building (kasikorn bank office building no.3)-63d09489daaa3.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-25 09:30:50', 'acsadmin', '2023-01-25 09:31:37', 'acsadmin'),
(95, 'ขยายอาคารเทคนิคใหม่  สถานีโทรทัศน์สีกองทับบกช่อง 7', 'New technical building expansion Royal Thai Army Television Station Channel 7', 3, 'เลขที่ 998/1 ซอยร่วมศิริมิตร (พหลโยธิน 18/1) ถ.พหลโยธิน แขวงจอมพล เขตจตุจักร กทม. 10900 \r\n\r\n', 'No. 998/1 Soi Ruamsirimit (Phaholyothin 18/1), Phaholyothin Road, Chomphon Subdistrict, Chatuchak District, Bangkok 10900', 61, 6, 5, 2, 3, 134, 6400, 'อาคารสูง 4 ชั้น (ไม่รวมชั้นดาดฟ้า) ภายในประกอบด้วยห้องประชุมและห้องทำงานต่างๆสำหรับผู้บริหารและเจ้าหน้าที่ของช่อง 7 สีพร้อมทั้งส่วนผลิตรายการและออกอากาศ\r\n', '4-storey building (excluding rooftop)\r\nwith meeting rooms and offices for executives\r\nand the staff of Channel 7, along with the production section\r\nand broadcast', '[\"new technical building expansion royal thai army television station channel 7-63d0990232cf1.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-25 09:50:07', 'acsadmin', '2023-01-25 09:50:42', 'acsadmin'),
(96, 'กลุ่มอาคารปฏิบัติการวิทยาศาสตร์เทคโนโลยีและชีวภาพการแพทย์', 'Science, Technology and Biomedical Laboratory Building Group', 3, 'คณะวิทยาศาสตร์ มหาวิทยาลัยมหิดล  กรุงเทพฯ\r\n', 'Faculty of Science Mahidol University, Bangkok', 62, 7, 24, 10, 3, 152, 9600, 'ศูนย์ตรวจสอบสารต้องห้ามในนักกีฬา สนามกีฬาในร่ม สระว่ายน้ำและอาคารเลี้ยงสัตว์ทดลอง\r\n', 'Doping testing center in athletes indoor stadium Swimming pool and laboratory animal building', '[\"science, technology and biomedical laboratory building group-63d09c5359206.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-01-25 10:04:23', 'acsadmin', '2023-01-25 10:04:51', 'acsadmin'),
(97, 'คอลัมน์ทาวเวอร์', 'Column Tower', 3, 'ถนนรัชดาภิเษก กรุงเทพมหานคร', 'Ratchadapisek Road Bangkok', 63, 6, 5, 2, 3, 2000, 114000, 'ประกอบด้วยอาคารสูง 42 ชั้น ใต้ดิน 3 ชั้น จำนวน 1 หลัง และอาคารสูง 10 ชั้น ใต้ดิน 4 ชั้น 	จำนวน 1 หลัง\r\n', 'It consists of a 42-storey building with 3 floors underground.\r\n1 building and 10-storey building, 4-storey underground, 1 building', '[\"column tower-63d09f9a14b2e.jpg\"]', '2549', '2551', '1', 'upload new image', 'authorized', NULL, '2023-01-25 10:17:36', 'acsadmin', '2023-01-25 10:18:50', 'acsadmin'),
(98, 'อาคารสำนักงานใหญ่ บริษัทจัดการและพัฒนาทรัพยากรน้ำภาคตะวันออก จำกัด ', 'Head office building Eastern Water Resources Development and Management Company Limited', 3, 'ถนนวิภาวดีรังสิต  กรุงเทพมหานคร\r\n', 'Vibhavadi Rangsit Road Bangkok', 64, 6, 5, 2, 3, 700, 27000, 'อาคารสำนักงานใหญ่สูง 23 ชั้นและชั้นใต้ดิน 1 ชั้น\r\n', 'The head office building is 23 floors high and 1 basement floor.', '[\"head office building eastern water resources development and management company limited-63d0a103bc0fe.jpg\"]', '0', '2550', '1', 'upload image', 'authorized', NULL, '2023-01-25 10:24:25', 'acsadmin', '2023-01-25 10:24:51', 'acsadmin'),
(99, 'SF PHAHONYOTHIN', 'SF PHAHONYOTHIN', 3, 'ถนนพหลโยธิน  กรุงเทพมหานคร\r\n', 'Phaholyothin Road, Bangkok', 65, 6, 5, 2, 3, 124, 28000, 'อาคารสำนักงานและอาคารจอดรถ สูง 15 ชั้น\r\n', 'Office building and parking building, 15 floors high', '[\"sf phahonyothin-63d0a4c31e78a.jpg\"]', '0', '2550', '1', 'upload image', 'authorized', NULL, '2023-01-25 10:40:14', 'acsadmin', '2023-01-25 10:40:51', 'acsadmin'),
(100, 'Imagimax Animation & Design ', 'Imagimax Animation & Design ', 3, ' ถนนนราธิวาสราชนครินทร์ กรุงเทพมหานคร\r\n', 'Narathiwat Ratchanakarin Road Bangkok', 66, 6, 5, 2, 3, 45, 2549, ' อาคารสตูดิโอ โครงสร้างคอนกรีต เสริมเหล็กสูง 3 ชั้น จำนวน 1 อาคาร\r\n', 'Studio building, concrete structure  Reinforced steel, 3 floors high, 1 building', '[\"imagimax animation & design -63d0aecf5dd6e.jpg\"]', '0', '2549', '1', 'upload image', 'authorized', NULL, '2023-01-25 11:23:06', 'acsadmin', '2023-01-25 11:23:43', 'acsadmin'),
(101, 'โครงการลงทุนของบริษัท การบินไทย จำกัด (มหาชน) ณ ท่าอากาศยานสุวรรณ', 'Investment project of Thai Airways International Public Company Limited at Suvarnabhumi Airport', 3, 'ท่าอากาศยานสุวรรณภูมิ จังหวัดสมุทรปราการ\r\n', 'Suvarnabhumi Airport Samut Prakan Province', 67, 16, 15, 6, 3, 13736, 725850, 'ศูนย์ซ่อมบำรุงอากาศยาน ลานจอดรถ ครัวการบินและอุปกรณ์ภาคพื้นศูนย์ปฏิบัติการพาณิชย์สินค้าและไปรษณีภัณฑ์ และศูนย์บริการลูกค้าภาคพื้นดิน\r\n', 'aircraft maintenance center, parking lot, aviation kitchen\r\nand ground equipment, commercial product operations center\r\nand mail and customer service center on the ground', '[\"investment project of thai airways international public company limited at suvarnabhumi airport-63d0ee0b0d340.jpg\"]', '0', '2548', '1', 'update project', 'authorized', NULL, '2023-01-25 15:52:55', 'acsadmin', '2023-01-26 15:31:15', 'acsadmin'),
(102, 'Thailand Creative & Design Center  (TCDC) ', 'Thailand Creative & Design Center   (TCDC) ', 3, 'ถนนสุขุมวิท  กรุงเทพมหานคร\r\n', 'Sukhumvit Road, Bangkok', 68, 6, 5, 2, 3, 75, 4964, 'เป็นโครงการก่อสร้างศูนย์จัดแสดงนิทรรศการ การประชุมและห้องสมุด โดยโครงการตั้งอยู่ภายใน	อาคารเอ็มโพเรียมทาวเวอร์ถนนสุขุมวิท\r\n', 'It is an exhibition center construction project.\r\nmeetings and libraries The project is located within Emporium Tower, Sukhumvit Road', '[\"thailand creative & design center -63d0ef928809e.jpg\",\"thailand creative & design center -63d0ef928851c.jpg\"]', '0', '2548', '1', 'update project', 'authorized', NULL, '2023-01-25 15:59:19', 'acsadmin', '2023-01-25 16:16:40', 'acsadmin'),
(103, 'อาคารสถาบันวิทยาการตลาดทุน (โครงการนอร์ธปาร์ค)', 'Capital Market Academy Building (North Park Project)', 3, 'ถนนวิภาวดีรังสิต กม.27  กรุงเทพมหานคร', 'Vibhavadi Rangsit Road Km.27, Bangkok', 60, 14, 27, 17, 3, 400, 9900, 'อาคารสูงเทคโนโลยีสารสนเทศ โครงสร้างคอนกรีตเสริมเหล็กสูง 5 ชั้น\r\n', 'information technology tall buildings structureReinforced concrete, \r\n5 floors high', '[\"capital market academy building (north park project)-63d0f4d80096b.jpg\"]', '0', '2548', '1', 'update project', 'authorized', NULL, '2023-01-25 16:21:52', 'acsadmin', '2023-01-26 15:30:40', 'acsadmin'),
(104, 'โครงการย้ายสำนักงานใหญ่ของดีเอชแอล', 'DHL Headquarters Relocation Project', 3, 'ถนนสาธรใต้ กรุงเทพมหานคร\r\n', 'South Sathorn Road, Bangkok', 28, 14, 29, 17, 3, 34, 5160, 'การย้ายหน่วยงานของ บริษัท DHL จากอาคารแกรนด์	อมรินทร์ทาวเวอร์ ชั้น 21 และ 22 ไปสู่อาคารสาธรซิตี้ทาวเวอร์ ชั้นที่ 7และ 8 และตกแต่งภายในพร้อมติดตั้งระบบอุปกรณ์ต่าง ๆ\r\n', 'Relocation of DHL Company Units from the Grand Building Amarin Tower, 21st and 22nd floor to Sathorn City Tower\r\nTower, 7th and 8th floor, and decorated with\r\nInstall various devices', '[\"dhl headquarters relocation project-63d228db64b92.jpg\"]', '0', '2547', '1', 'update project', 'authorized', NULL, '2023-01-26 14:15:56', 'acsadmin', '2023-01-26 15:28:08', 'acsadmin'),
(105, 'Amarin Corporate Park', 'Amarin Corporate Park', 3, 'ถนนชัยพฤกษ์  กรุงเทพมหานคร\r\n', 'Chaiyaphruek Road, Bangkok', 69, 20, 21, 12, 3, 105, 7000, '      กลุ่มอาคารสำนักงานและอาคาร ประกอบสูง 3 ชั้น รวม 5 อาคาร\r\n', 'Office buildings and buildings Consists of 3 floors, a total of 5 buildings.', '[\"amarin corporate park-63d22e4cad369.jpg\"]', '0', '2546', '1', 'upload image', 'authorized', NULL, '2023-01-26 14:39:31', 'acsadmin', '2023-01-26 14:39:56', 'acsadmin'),
(106, 'Bashundhara City Project (ประเทศบังคลาเทศ)', 'Bashundhara City Project', 3, 'กรุงดัคคา  ประเทศบังคลาเทศ\r\n\r\n', 'Dakka, Bangladesh', 70, 11, 24, 10, 3, 4000, 160000, 'อาคารจอดรถสูง 9 ชั้น', '9-storey car park building', '[\"bashundhara city project-63d2309d361a1.jpg\"]', '0', '2545', '1', 'upload image', 'authorized', NULL, '2023-01-26 14:49:20', 'acsadmin', '2023-01-26 14:49:49', 'acsadmin'),
(107, 'สถาบันพัฒนาฝีมือแรงงานกลาง  จ. สมุทราปราการ ', 'Samutprakarn Institute For Skill Development ', 3, 'อำเภอบางพลี  จังหวัดสมุทรปราการ\r\n', 'Bang Phli District, Samut Prakan Province', 71, 1, 21, 9, 3, 4000, 53000, 'อาคารอำนวยการและฝึกอบรมสูง 12 ชั้น อาคารปฎิบัติงานช่าง อาคารเอนกประสงค์\r\nและอาคารรักษาความปลอดภัย\r\n', '12-storey administrative and training building\r\nMechanic work building multipurpose building\r\nand security building', '[\"samutprakarn institute for skill development -63d232b96fb4b.jpg\"]', '0', '2545', '1', 'upload image', 'authorized', NULL, '2023-01-26 14:56:35', 'acsadmin', '2023-01-26 14:58:49', 'acsadmin'),
(108, 'อาคารเอนกประสงค์และที่จอดรถ  สถาบันบัณฑิตพัฒนบริหารศาสตร์', 'multipurpose building and parking The National Institute of Development Administration-NIDA', 3, 'ถนนเสรีไทย  กรุงเทพมหานคร\r\n', 'Seri Thai Road, Bangkok', 72, 6, 5, 2, 3, 348, 50000, 'อาคารเอนกประสงค์ในการบริหารงานกิจการทาง	การศึกษา ประกอบด้วย สำนักงานห้องสมุด และ	ส่วนการเรียนการสอนสูง 12 ชั้น\r\n', 'A multi-purpose building for educational affairs administration consisting of a library office and a 12-storey learning and teaching section.', '[\"multipurpose building and parking the national institute of development administration-nida-63d23476e1f73.jpg\"]', '0', '2540', '1', 'upload image', 'authorized', NULL, '2023-01-26 15:05:15', 'acsadmin', '2023-01-26 15:06:14', 'acsadmin'),
(109, 'ไทยวาทาวเวอร์ 2 ', 'Thai Wah Tower 2', 3, 'ถนนสาทรใต้  กรุงเทพมหานคร', 'South Sathorn Road, Bangkok', 73, 5, 30, 9, 3, 2030, 57376, 'อาคารสำนักงานสูง 61 ชั้น สูง 164 เมตรเสาเข็มเจาะ	ขนาดเส้นผ่าศูนย์กลาง0.80 เมตรถึง 1.50 เมตร ลึก 50 เมตร	จำนวน 174 ต้น\r\n', '61-storey office building, 164 meters high, bored piles\r\nDiameter 0.80 m. to 1.50 m.\r\n50 meters deep, 174 trees', '[\"thai wah tower 2-63d237850f424.jpg\",\"thai wah tower 2-63d237850f63e.jpg\"]', '0', '2539', '1', 'update project', 'authorized', NULL, '2023-01-26 15:17:58', 'acsadmin', '2023-01-26 15:24:16', 'acsadmin'),
(110, 'เดอะ รีเซิร์ฟ 61 ไฮด์อะเวย์', 'The Reserve 61 Hideaway  ', 4, 'ถนนสุขุมวิท 61 คลองเตยเหนือ เขตวัฒนา  กรุงเทพมหานคร\r\n', 'Sukhumvit 61 Road, Klongtoey Nua, Watthana, Bangkok', 40, 6, 5, 2, 3, 680, 27097, 'ประกอบด้วยอาคารพักอาศัยสูง 7 ชั้น  ชั้นใต้ดิน 1 ชั้นและอาคารจอดรถสูง 1 ชั้น \r\nชั้นใต้ดิน 3 ชั้น\r\n', 'It consists of a 7-storey residential building.\r\n1 basement floor and 1 floor parking building\r\n3 floors basement', '[\"the reserve 61 hideaway  -63d23cec50736.jpg\"]', '2562', '2565', '1', 'upload image', 'authorized', NULL, '2023-01-26 15:39:57', 'acsadmin', '2023-01-26 15:42:20', 'acsadmin'),
(111, 'ไซมิส สุขุมวิท 87 ', 'Siamese Sukhumvit 87', 4, 'สุขุมวิท 87 บางจาก เขตพระโขนง  กรุงเทพฯ\r\n', 'Sukhumvit 87, Bang Chak, Phra Khanong, Bangkok', 40, 6, 5, 2, 2, 630, 18770, 'อาคารพักอาศัยสูง 25 ชั้น จำนวน 1 อาคาร\r\n', '25-storey residential building, 1 building', '[\"siamese sukhumvit 87-63d23f39b296d.jpeg\"]', '2561', '2564', '1', 'update project', 'authorized', NULL, '2023-01-26 15:51:44', 'acsadmin', '2023-01-26 16:54:14', 'acsadmin'),
(112, ' เดอะ รีเซิร์ฟ สุขุมวิท 61', 'The Reserve Sukhumvit 61 ', 4, 'ถนนสุขุมวิท 61 แขวงคลองเตยเหนือ \r\n', 'Sukhumvit 61 Road, Khlong Toei Nuea Subdistrict', 40, 6, 5, 2, 3, 900, 18770, 'โดยในโครงการนี้จะเน้นพื้นที่ส่วนกลางที่เป็นสไตล์รีสอร์ท  ให้ความเงียบสงบ และถึงแม้เป็นคอนโดรูปแบบ Low Rise อาคารสูง 7 ชั้น จำนวน 2 อาคาร เพื่อให้ได้ความสูง Floor To Ceiling ที่มากถึง 2.70 เมตร และที่นี่ยังมียูนิตพิเศษอย่าง Duplex & Triplex  \r\n\r\n', 'In this project, the emphasis will be on the resort-style common area. keep calm And although it is a low-rise condominium, 7-storey buildings, 2 buildings to get a height of Floor To Ceiling of up to 2.70 meters, and here there are also special units like Duplex & Triplex.', '[\"the reserve sukhumvit 61 -63d39ee81799c.jpg\",\"the reserve sukhumvit 61 -63d39ee817d02.jpg\"]', '2561', '2563', '1', 'upload new image', 'authorized', NULL, '2023-01-27 16:48:12', 'acsadmin', '2023-01-27 16:52:40', 'acsadmin'),
(113, 'ไซมิส สุขุมวิท 48 ', 'Siamese Sukhumvit 48', 4, 'ถนนสุขุมวิท 48 แขวงพระโขนง เขตคลองเตย 	กรุงเทพฯ \r\n', 'Sukhumvit 48 Road, Phra Khanong Subdistrict, Khlong Toei District, Bangkok', 75, 6, 5, 2, 3, 880, 26470, 'ประกอบด้วยอาคารพักอาศัยสูง 39 ชั้นจำนวน 1 อาคาร  และอาคารชุดพาณิชย์และ	สำนักงานสูง 5 ชั้น ชั้นใต้ดิน 2 ชั้น จำนวน 1 อาคาร\r\n\r\n', 'It consists of a 39-storey residential building.\r\n1 building and 5-storey commercial condominium and office building with 2 basement floors, 1 building', '[\"siamese sukhumvit 48-63d3a6ad2992f.jpg\"]', '2559', '2563', '1', 'upload image', 'authorized', NULL, '2023-01-27 17:25:30', 'acsadmin', '2023-01-27 17:25:49', 'acsadmin'),
(114, 'ศูนย์การเรียนรู้ธนาคารกสิกรไทย บางปะกง ', 'Kasikornbank Learning Center Bangpakong', 4, ' อำเภอบางปะกง จังหวัดฉะเชิงเทรา\r\n', 'Bangpakong District, Chachoengsao Province', 76, 6, 5, 2, 3, 210, 18168, 'ประกอบด้วยอาคารพักอาศัยสูง 4 ชั้น, อาคาร 	ห้องอาหารใหม่สูง 2 ชั้น,  อาคาร Auditorium  สูง 3 ชั้น และงานปรับปรุงอาคารห้องอาหารเดิม และอาคารพักอาศัยเดิม \r\n', 'Consists of a 4-storey residential building, a 2-storey new restaurant building, and the Auditorium building.\r\n3 storeys high and renovating the original restaurant building\r\nand the original residential building', '[\"kasikornbank learning center bangpakong-63d3a89a5b5ba.jpg\"]', '0', '2563', '1', 'upload image', 'authorized', NULL, '2023-01-27 17:33:01', 'acsadmin', '2023-01-27 17:34:02', 'acsadmin'),
(115, 'วิช ซิกเนเจอร์ มิดทาวน์ สยาม', 'Wish Signature Midtown Siam ', 4, 'ถนนเพชรบุรี แขวงราชเทวี เขตราชเทวี กรุงเทพมหานคร', 'Phetchaburi Road, Ratchathewi Subdistrict, Ratchathewi District, Bangkok', 77, 6, 5, 2, 3, 1400, 46789, 'ประกอบด้วยอาคารพักอาศัยสูง 45 ชั้น	\r\nชั้นใต้ดิน 4 ชั้น (623 ห้อง)  จำนวน 1 อาคาร\r\n', 'It consists of a 45-storey residential building, 4-storey basement (623 rooms), 1 building.', '[\"wish signature midtown siam -63d3aaa11a636.jpg\"]', '2559', '2562', '1', 'upload image', 'authorized', NULL, '2023-01-27 17:41:56', 'acsadmin', '2023-01-27 17:42:41', 'acsadmin'),
(116, 'เดอะ ทรี ริโอ (บางอ้อ)', 'The Tree Rio ', 4, 'ถ. จรัญสนิทวงศ์ แขวงบางอ้อ เขตบางพลัด กรุงเทพมหานคร', 'Charansanitwong Road, Bang Or Subdistrict, Bang Phlat District, Bangkok', 40, 6, 5, 2, 3, 1607, 96000, 'ประกอบด้วยอาคารพักอาศัยสูง 41 ชั้น (1,335 ห้อง)  จำนวน 1 อาคาร\r\n', 'It consists of a 41-storey residential building.\r\n(1,335 rooms) 1 building', '[\"the tree rio -63db379a32b94.jpg\",\"the tree rio -63db379a32e0c.jpg\",\"the tree rio -63db379a32fbe.jpg\",\"the tree rio -63db379a331a0.jpg\",\"the tree rio -63db379a33335.jpg\"]', '0', '2560', '1', 'upload image', 'authorized', NULL, '2023-02-02 11:04:35', 'acsadmin', '2023-02-02 11:10:02', 'acsadmin'),
(117, 'บ้านโอสถานุเคราะห์ ', 'Osathanugrah House', 4, 'ซอยสุขุมวิท 34 ถนนสุขุมวิท กรุงเทพมหานคร\r\n', 'Soi Sukhumvit 34, Sukhumvit Road, Bangkok', 78, 6, 5, 2, 3, 145, 7438, 'อาคารพักอาศัยสูง 7 ชั้นจำนวน 1 อาคาร\r\n', '7-storey residential building, 1 building', '[\"osathanugrah house-63db3b7dca9ee.jpg\"]', '0', '2561', '1', 'upload image', 'authorized', NULL, '2023-02-02 11:26:18', 'acsadmin', '2023-02-02 11:26:37', 'acsadmin'),
(118, 'ริชพาร์ค เจ้าพระยา เชิงสะพานพระนั่งเกล้า', 'Rich Park @ Chaophraya', 4, 'รัตนาธิเบศร์ ไทรม้า อำเภอเมือง นนทบุรี', 'Rattanathibet Sai Ma, Muang District, Nonthaburi', 79, 6, 5, 2, 3, 637, 37500, 'ประกอบด้วยอาคารพักอาศัยสูง 33 ชั้น  663 ยูนิต จำนวน 1 อาคาร\r\n', 'Consists of a 33-storey residential building, 663 units, 1 building', '[\"rich park @ chaophraya-63db3d76ae4d1.jpg\"]', '0', '2559', '1', 'upload image', 'authorized', NULL, '2023-02-02 11:34:01', 'acsadmin', '2023-02-02 11:35:02', 'acsadmin'),
(119, 'ดิ เอนเนอร์จี้ หัวหิน', 'The Energy Hua-Hin ', 4, 'อำเภอชะอำ จังหวัดเพชรบุรี\r\n', 'Cha-am District, Phetchaburi Province', 80, 6, 5, 2, 3, 5220, 358400, 'ประกอบด้วยอาคารคอนโดมิเนียมสูง 8 ชั้น จำนวน 33 อาคาร, อาคารโรงแรมสูง \r\n7 ชั้น  1 อาคาร, อาคาร Sport Complex สูง 3 ชั้น 1 อาคาร เป็นต้น\r\n', 'Consists of 33 8-storey condominium buildings, high-rise hotel buildings\r\n7 floors, 1 building, 3-storey Sport Complex building, 1 building, etc.', '[\"the energy hua-hin -63db4121c3c99.jpg\"]', '2554', '2557', '1', 'upload image', 'authorized', NULL, '2023-02-02 11:48:57', 'acsadmin', '2023-02-02 11:50:41', 'acsadmin'),
(120, 'เอสเซนท์ เอกมัย 19', 'Ascent Condominium @ Ekamai 19', 4, 'ซอยเอกมัย 19  กรุงเทพมหานคร\r\n', 'Soi Ekkamai 19, Bangkok', 81, 6, 5, 2, 3, 170, 9075, 'ประกอบด้วยอาคารพักอาศัยสูง 8 ชั้นและชั้นใต้ดิน 1 ชั้น จำนวน 1 อาคาร\r\n', 'It consists of an 8-storey residential building.\r\nand 1 basement floor, 1 building', '[\"ascent condominium @ ekamai 19-63db53aebfa9c.jpg\"]', '0', '2558', '1', 'upload image', 'authorized', NULL, '2023-02-02 13:08:09', 'acsadmin', '2023-02-02 13:09:50', 'acsadmin'),
(121, 'มายรีสอร์ท หัวหิน ', 'My Resort @ Hua Hin ', 4, 'ถนนเขาตะเกียบ  ตหนองแก อำเภอหัวหิน \r\n', 'Khao Takiab Road, Nong Kae Subdistrict, Hua Hin District', 82, 6, 5, 2, 3, 480, 30000, 'ประกอบด้วยอาคารพักอาศัยสูง 7 ชั้น และชั้นใต้ดิน 1 ชั้น จำนวน 3 อาคาร\r\nแต่ละอาคาร จำนวนห้อง 211 ห้อง', 'It consists of 7-storey residential buildings and 1 basement floor, 3 buildings.\r\nEach building has 211 rooms.', '[\"my resort @ hua hin -63db58de0d20c.jpg\",\"my resort @ hua hin -63db58de0d490.jpg\",\"my resort @ hua hin -63db58de0d681.jpg\"]', '0', '2557', '1', 'upload image', 'authorized', NULL, '2023-02-02 13:31:31', 'acsadmin', '2023-02-02 13:31:58', 'acsadmin'),
(122, 'เดอะคิทท์ พลัส นวมินทร์', 'The Kith Plus @ Nawamin', 4, 'ซอย 163 ถนนนวมินทร์ เขตบึงกุ่ม  กรุงเทพมหานคร', 'Nawamin Road, Bueng Kum District, Bangkok', 84, 6, 5, 2, 3, 191, 19644, 'ประกอบด้วยอาคารพักอาศัยสูง 8 ชั้น จำนวน 2 อาคาร 406 ยูนิต\r\n', 'It consists of 2 8-storey residential buildings with 406 units.', '[\"the kith plus @ nawamin-63db5df693765.jpg\"]', '2555', '2557', '1', 'upload image', 'authorized', NULL, '2023-02-02 13:52:10', 'acsadmin', '2023-02-02 13:53:42', 'acsadmin'),
(123, 'คอนโด เดอะ โคสต์ แบงค็อก (สุขุมวิท-บางนา)', 'Condo The Coast Bangkok (Sukhumvit-Bangna)', 4, 'ถนนสุขุมวิท แขวงบางนา กรุงเทพมหานคร', 'Sukhumvit Road, Bangna Subdistrict, Bangkok', 85, 14, 27, 17, 3, 1287, 75010, 'คอนโดมิเนียมสูง 39 ชั้น จำนวน 1 อาคาร (อาคารA) และสูง 35 ชั้น จำนวน 1 อาคาร 	(อาคาร B) และอาคารศูนย์ค้าปลีกสูง 2 ชั้น	บนพื้นที่ 8 ไร่ 2 งาน \r\n', '39-storey condominium, 1 building\r\n(Building A) and 1 building with 35 floors (Building B) and a 2-storey retail center building on an area of 8 rai 2 ngan.', '[\"condo the coast bangkok (sukhumvit-bangna)-63db61dfe0297.jpg\",\"condo the coast bangkok (sukhumvit-bangna)-63db61dfe0483.jpg\"]', '0', '2557', '1', 'upload image', 'authorized', NULL, '2023-02-02 14:09:39', 'acsadmin', '2023-02-02 14:10:23', 'acsadmin'),
(124, 'ศุภาลัย ริเวอร์ รีสอร์ท', 'Supalai River Resort', 4, 'ถนนเจริญนคร กรุงเทพมหานคร\r\n', 'Charoen Nakhon Road, Bangkok', 86, 6, 5, 2, 3, 2000, 100987, 'อาคารคอนกรีตเสริมเหล็ก 42 ชั้น จำนวน 1 อาคาร และอาคารคอนกรีตเสริมเหล็ก 5 ชั้น จำนวน 4 คูหา', 'One 42-storey reinforced concrete building and 4 units of 5-storey reinforced concrete building', '[\"supalai river resort-63db6980b373d.jpg\",\"supalai river resort-63db6980b3d4a.jpg\"]', '0', '2557', '1', 'upload new image', 'authorized', NULL, '2023-02-02 14:32:35', 'acsadmin', '2023-02-02 14:42:56', 'acsadmin'),
(125, 'เวอร์ทีค พระราม 4 – สยาม', 'Vertiq Rama 4 - Siam', 4, 'ถนนสี่พระยา เขตบางรัก กรุงเทพมหานคร\r\n', 'Si Phraya Road, Bang Rak District, Bangkok', 77, 6, 5, 2, 3, 599, 23000, 'อาคารสูง 23 ชั้น และชั้นใต้ดิน 4 ชั้น ประกอบด้วย หอพัก 196 ยูนิต \r\nพร้อมด้วยสิ่งอำนวยความสะดวกต่าง ๆ\r\n\r\n', 'A 23-storey building with 4 basement floors consisting of\r\nDormitory 196 units with various facilities', '[\"vertiq rama 4 - siam-63db6afb56ddf.jpg\"]', '0', '2557', '1', 'upload image', 'authorized', NULL, '2023-02-02 14:48:47', 'acsadmin', '2023-02-02 14:49:15', 'acsadmin'),
(126, 'มายรีสอร์ท แอท ริเวอร์', 'My Resort at River', 4, 'ถนนจรัญสนิทวงศ์ กรุงเทพมหานคร\r\n', 'Charansanitwong Road Bangkok', 87, 6, 5, 2, 3, 547, 41875, 'ปรับปรุงอาคารชุดพักอาศัยสูง 36 ชั้น จำนวน 1 หลัง มีห้องชุด จำนวน 120 ยูนิต และ\r\nห้องเพนท์เฮ้าส์ จำนวน 1 ยูนิต และงานปรับปรุงอาคาร Marina Suite(ทาวน์เฮาส์)สูง  4 ชั้น จำนวน 4 ยูนิต\r\n', 'Renovation of a 36-storey residential building with 120 units and a penthouse.\r\nof 1 unit and renovation of the Marina Suite building (townhouse), 4 floors high, of 4 units', '[\"my resort at river-63db7219a3579.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-02-02 15:18:46', 'acsadmin', '2023-02-02 15:19:37', 'acsadmin'),
(127, 'ลิฟท์โดยสาร โรงแรมแลนด์มาร์ค ', 'Passenger elevator Landmark Hotel', 2, 'ถนนสุขุมวิม คลองเตย กรุุงเทพ', 'Sukhumvit Road, Khlong Toei, Bangkok', 88, 2, 1, 8, 3, 0, 0, 'ลิฟท์โดยสาร บริเวณ ชั้น 3 ของอาคาร', 'Passenger elevator on the 3rd floor of the building', NULL, '2551', '0', '1', 'create project', 'authorized', NULL, '2023-02-08 17:58:04', 'acs@chivatip', '2023-02-08 17:58:04', 'acs@chivatip'),
(128, 'ดิ โอเรียนเต็ล เรสสิเดนซ์', ' The Oriental Residence ', 4, 'เลขที่  110 ถนนวิทยุ  แขวง ลุมพินี เขต ปทุมวัน กรุงเทพมหานคร 10330\r\n\r\n', 'No. 110 Wireless Road, Lumpini Subdistrict, Pathumwan District, Bangkok 10330', 90, 18, 22, 15, 3, 1500, 34066, 'อาคารพักอาศัยสูง 32 ชั้น และชั้นใต้ดิน 4.5 ชั้น จำนวน 1 อาคาร โดยชั้นใต้ดินใช้เป็นส่วนจอดรถยนต์ ชั้น 1-5 เป็น	ส่วนโพเดียม ชั้น 6-21 เป็นส่วนเซอร์วิสอพาร์ตเมนต์ \r\nและชั้น 22-31 เป็นส่วนคอนโดมิเนียม\r\n', 'A 32-storey residential building with 4.5 basement floors, 1 building in which the basement is used as a car park, floors 1-5 are podiums, floors 6-21 are serviced apartments, and floors 22-31 are condominiums.', '[\" the oriental residence -63ec6d70d8e1a.jpg\"]', '0', '2555', '1', 'upload image', 'authorized', NULL, '2023-02-15 12:27:46', 'acsadmin', '2023-02-15 12:28:16', 'acsadmin'),
(129, 'วิช แอท สามย่าน คอนโดมิเนียม', 'WISH @ SAMYAN CONDOMIMIUM', 4, 'ถนนพระราม 4  กรุงเทพมหานคร\r\n', 'Rama IV Road, Bangkok', 91, 6, 5, 2, 3, 559, 30000, 'อาคารคอนกรีตเสริมเหล็ก สูง 24 ชั้น  จำนวน 1 อาคาร ห้องพัก อาศัยรวม 465 ยูนิต\r\n', 'Rama 4 Road, Bangkok, 24-storey reinforced concrete building, 1 building, 465 residential units', '[\"wish @ samyan condomimium-63ec70cc55457.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-02-15 12:41:46', 'acsadmin', '2023-02-15 12:42:36', 'acsadmin'),
(130, 'เดอะนิช ซิตี้ ลาดพร้าว 130', 'THE NICHE CITI Ladprao 130', 4, 'ซอยลาดพร้าว 130 แยกไดรว์อิน 5 ถนนลาดพร้าว \r\nแขวงคลองจั่น เขตบางกระปิ กรุงเทพมหานคร\r\n', 'Soi Ladprao 130, Drive-in Intersection 5, Ladprao Road\r\nKhlong Chan Subdistrict, Bang Kapi District, Bangkok', 84, 6, 5, 2, 3, 24, 36218, 'อาคารพักอาศัยสูง 8 ชั้น (ไม่มีชั้นใต้ดิน)\r\nจำนวน 4 อาคาร จำนวน 806 ยูนิต\r\n', '8-storey residential building (no basement)\r\n4 buildings, 806 units', '[\"the niche citi ladprao 130-63ec773bd025c.jpg\",\"the niche citi ladprao 130-63ec773bd0672.jpg\",\"the niche citi ladprao 130-63ec773bd0939.jpg\",\"the niche citi ladprao 130-63ec773bd0b76.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-02-15 13:03:39', 'acsadmin', '2023-02-15 13:10:03', 'acsadmin'),
(131, 'คอนโด ไนซ์ สวีทส์ สนามบินน้ำ', 'Nice Suites Sanambinnam ', 4, 'ตั้งอยู่บน ซอยเลี่ยงเมืองนนทบุรี 14 ท่าทราย อ.เมืองนนทบุรี จ.นนทบุรี 11000', 'Located on Soi Bypass Muang Nonthaburi 14, Tha Sai, Muang Nonthaburi District, Nonthaburi Province 11000', 93, 6, 5, 2, 3, 148, 8569, 'อาคารชุดพักอาศัยสูง 8 ชั้นจำนวน 168 ยูนิค 	\r\nจำนวน 3 อาคาร บนเนื้อทีประมาณ 3 ไร่\r\n', '8-storey residential building, 168 units\r\n3 buildings on an area of approximately 3 rai', '[\"nice suites sanambinnam -63ec7ca9302e6.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-02-15 13:32:25', 'acsadmin', '2023-02-15 13:33:13', 'acsadmin'),
(132, 'ถนนสุขุมวิท 31 อพาร์ทเมนท์', 'Sukhumvit 31 Road Apartments', 4, 'ถนนสุขุมวิท 31 กรุงเทพมหานคร\r\n', 'Sukhumvit 31 Road, Bangkok', 94, 6, 5, 2, 3, 233, 12886, 'อาคารคอนกรีตเสริมเหล็กสูง 16 ชั้น จำนวน 1 อาคาร \r\nห้องพัก จำนวน 34 ห้อง และสิ่งอำนวยความสะดวกต่าง ๆ รวมทั้งที่จอดรถ\r\n', '16-storey reinforced concrete building, 1 building\r\n34 rooms and facilities including parking', '[\"sukhumvit 31 road apartments-63ec864697c58.jpg\"]', '0', '2554', '1', 'upload image', 'authorized', NULL, '2023-02-15 14:13:40', 'acsadmin', '2023-02-15 14:14:14', 'acsadmin'),
(133, 'วิช แอท สยาม คอนโคมิเนียม', 'WISH @ Siam Condominium', 4, 'ถนนบรรทัดทอง แขวง ถนนเพชรบุรี เขต ราชเทวี กรุงเทพมหานคร 10400\r\n\r\n', 'Banthat Thong Road, Thanon Phetchaburi, Ratchathewi, Bangkok 10400', 91, 6, 5, 2, 3, 286, 16000, 'อาคารคอนโดมิเนียมสูง 8 ชั้น \r\nชั้นใต้ดินลึก 1 ชั้น จำนวน 2 อาคาร\r\n', '8-storey condominium building\r\n1 deep basement, 2 buildings', '[\"wish @ siam condominium-63ec8aa0e2de4.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-02-15 14:31:17', 'acsadmin', '2023-02-15 14:32:48', 'acsadmin'),
(134, 'อมันตา ลุมพินี คอนโดมิเนียม', 'Amanta Lumpini ', 4, '1100/18 ถนนพระรามที่ 4 แขวง ทุ่งมหาเมฆ เขตสาทร กรุงเทพมหานคร 10120 ', '1100/18 Rama IV Road, Thungmahamek, Sathorn, Bangkok 10120', 96, 21, 31, 2, 3, 1200, 47652, 'อาคารคอนโดมิเนียม โครงสร้างคอนกรีตเสริมเหล็ก จำนวน 1 อาคาร \r\nมีความสูง 44 ชั้นและ 17 ชั้น 	และห้องเครื่องบริเวณชั้นใต้ดิน\r\n', 'condominium building Reinforced concrete structure, 1 building with a height of 44 floors and 17 floors, and a machine room in the basement.', '[\"amanta lumpini -63ec90a67e7cd.jpg\",\"amanta lumpini -63ec90a67ea7d.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-02-15 14:56:52', 'acsadmin', '2023-02-15 14:58:30', 'acsadmin'),
(135, 'เดอะ วินด์ สุขุมวิท 23', 'The Wind Sukhumvit 23', 4, 'ถนนสุขุมวิท 23  กรุงเทพมหานคร\r\n', 'Sukhumvit 23 Road, Bangkok', 97, 6, 5, 2, 3, 800, 24928, 'คอนโดมิเนียมพักอาศัยขนาด 220 ห้อง สูง 22 ชั้น ประกอบด้วยที่จอดรถ สูง 3 ชั้น\r\nส่วนพักอาศัยและส่วนกลาง 19 ชั้น\r\n', 'Residential condominium with 220 rooms, 22 floors high, \r\nconsisting of 3 floors of parking.\r\n19 floors of residential and central areas', '[\"the wind sukhumvit 23-63f06a5db6c92.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-02-18 13:03:33', 'acsadmin', '2023-02-18 13:04:13', 'acsadmin'),
(136, 'บ้านมนธิดา', 'Baan Montida ', 4, 'ถนนสุขุมวิท 101  กรุงเทพมหานคร', 'Sukhumvit 101 Road, Bangkok', 98, 13, 26, 11, 3, 500, 16000, 'อาคารพักอาศัยสูง 20 ชั้น 1 อาคาร\r\n\r\n', '20-storey residential building, 1 building', '[\"baan montida -63f06c839b9f4.jpg\"]', '0', '2553', '1', 'upload image', 'authorized', NULL, '2023-02-18 13:12:40', 'acsadmin', '2023-02-18 13:13:23', 'acsadmin'),
(137, ' บ้านราชประสงค์ (ราชดำริ) ', 'BAAN RAJPRASONG', 4, 'ถนนราชดำริ  กรุงเทพมหานคร', 'Ratchadamri Road, Bangkok', 80, 3, 32, 12, 3, 1192, 43121, 'อาคารคอนกรีตเสริมเหล็ก สูง 34 ชั้น 	ดาดฟ้าสูง 2 ชั้น และชั้นใต้ ดินลึก 1 ชั้น 	\r\nจำนวน 1 อาคาร เพื่อใช้เป็นอาคารชุดพักอาศัย พร้อมที่จอดรถ จำนวน 295 คัน\r\n', 'A 34-storey reinforced concrete building, 2-storey rooftop and 1 deep basement, 1 building for use as a residential condominium. with parking for 295 cars', '[\"baan rajprasong-63f06fdf31a8f.jpg\",\"baan rajprasong-63f06fdf31cd9.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-02-18 13:26:07', 'acsadmin', '2023-02-18 13:27:43', 'acsadmin'),
(138, ' เดอะ นิช ลาดพร้าว 48', 'The Niche Ladprao 48', 4, 'ถนนลาดพร้าว  กรุงเทพมหานคร\r\n', 'Ladprao Road, Bangkok', 84, 14, 27, 17, 3, 108, 9999, ' เป็นคอนโด Low Rise  2 อาคาร สูง 8 ชั้น \r\n ห้องพักจำนวน 263 ยูนิต ไม่มีชั้นใต้ดิน', 'It is a low rise condo, 2 buildings, 8 floors high.\r\n 263 units, no basement', '[\"the niche ladprao 48-63f0eb8f44062.jpg\"]', '0', '2552', '1', 'update project', 'authorized', NULL, '2023-02-18 22:14:08', 'acsadmin', '2023-02-18 22:16:01', 'acsadmin'),
(139, 'บ้านสุขุมวิท 14', 'Baan Sukhumvit 14', 4, 'ถนนสุขุมวิท  กรุงเทพมหานคร\r\n', 'Sukhumvit Road, Bangkok', 99, 3, 32, 12, 3, 83, 4000, 'อาคารพักอาศัยสูง 8 ชั้น และชั้นใต้ดิน 1 ชั้น สำหรับ	\r\nห้องเครื่องและแทงค์น้ำ และงานต่อเติมสระว่ายน้ำบนชั้นดาดฟ้า \r\nจำนวน 1 อาคาร\r\n', '8-storey residential building and 1 basement floor for machine rooms and water tanks. and swimming pool renovation work\r\nOn the rooftop of 1 building', '[\"baan sukhumvit 14-63f1d4924888b.jpg\"]', '0', '2552', '1', 'upload image', 'authorized', NULL, '2023-02-19 14:49:09', 'acsadmin', '2023-02-19 14:49:38', 'acsadmin'),
(140, 'เดอะ สตาร์ เอสเตท แอท นราธิวาสราชนครินทร์', 'The Star Estate @ Narathiwas', 4, 'ถนนนราธิวาสราชนครินทร์ กรุงเทพมหานคร', 'Narathiwat Ratchanakarin Road Bangkok', 100, 22, 29, 17, 3, 733, 42000, 'อาคารพักอาศัย จำนวน 211 ยูนิต และที่ \r\nจอดรถยนต์สูง 20 ชั้น และชั้นใต้ดินครึ่งชั้น\r\n', 'Residential buildings of 211 units and\r\n20-storey car park and half basement', '[\"the star estate @ narathiwas-63f1da6cd1b97.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-02-19 15:14:14', 'acsadmin', '2023-02-19 15:14:36', 'acsadmin'),
(141, 'เดอะ แกรนด์ เศรษฐีวรรณ สุขุมวิท 24', 'The Grand Sethiwan Sukhumvit 24 ', 4, 'ซอยสุขุมวิท 24  กรุงเทพมหานคร\r\n', 'Soi Sukhumvit 24, Bangkok', 101, 10, 23, 18, 3, 1300, 54000, 'อาคารเพื่อใช้เป็น ห้องชุดพักอาศัยและที่จอดรถ\r\nสูง 40 ชั้น 1 อาคาร และ 25 ชั้น 1 อาคาร\r\n', 'building to be used as Residential units and parking spaces\r\n40 floors, 1 building and 25 floors, 1 building', '[\"the grand sethiwan sukhumvit 24 -63f1de1bb4747.jpg\"]', '0', '2551', '1', 'update project', 'authorized', NULL, '2023-02-19 15:29:29', 'acsadmin', '2023-02-19 15:34:33', 'acsadmin'),
(142, 'วสุ เดอะเรสซิเดนซ์', 'Vasu The Residence ', 4, 'ถนนสุขุมวิท  กรุงเทพมหานคร\r\n', 'Sukhumvit Road, Bangkok', 102, 14, 27, 17, 3, 369, 22000, 'เป็นอาคารพักอาศัย สูง 22 ชั้น และ ชั้นใต้ดิน 1 ชั้น \r\n', 'It is a 22-storey residential building with 1 basement floor.', '[\"vasu the residence -63f1e0694937c.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-02-19 15:39:08', 'acsadmin', '2023-02-19 15:40:09', 'acsadmin'),
(143, 'เดอะนิช สุขุมวิท 49', 'The Niche Sukhumvit 49', 4, 'อยู่ในซอยสุขุมวิท 49 ถนนสุขุมวิท แขวงคลองตันเหนือ เขตวัฒนา กทม', 'Located in Soi Sukhumvit 49, Sukhumvit Road, Khlong Tan Nuea Subdistrict, Wattana District, Bangkok.', 84, 14, 27, 17, 3, 152, 2551, 'เป็นคอนโด Low Rise 8 ชั้น + 1 ชั้นใต้ดิน 1 อาคาร มีห้องพัก 140 ห้อง \r\nและที่จอดรถ 74 คัน\r\n', 'It is a low-rise condo with 8 floors + 1 basement floor, 1 building with 140 rooms. and parking for 74 cars', '[\"the niche sukhumvit 49-63f33246cb0d9.jpg\"]', '0', '2551', '1', 'upload image', 'authorized', NULL, '2023-02-20 15:40:54', 'acsadmin', '2023-02-20 15:41:42', 'acsadmin'),
(144, 'ศุภาลัย คาซา ริวา', 'Supalai Casa Riva', 4, 'ถนนเจริญกรุง  กรุงเทพมหานคร\r\n', 'Charoen Krung Road, Bangkok', 86, 14, 27, 17, 3, 1500, 143505, ' อาคารพักอาศัยประกอบด้วยอาคารทั้งหมด\r\nจำนวน 6 อาคาร ได้แก่ อาคาร Vista 1,2 สูง 25 ชั้น , 	อาคาร River Fronte 1,2 	(Tower C,D ) สูง  33 ชั้น อาคารจอดรถและสโมสรของอาคารสูง 3 และ 5 ชั้น\r\n', 'Residential buildings consist of all buildings.\r\n6 buildings: Vista 1,2, 25 floors, River Fronte 1,2 (Tower C,D), 33 floors, car park and clubhouse of 3 and 5 floors', '[\"supalai casa riva-63f3340160bc2.jpg\"]', '0', '2550', '1', 'upload image', 'authorized', NULL, '2023-02-20 15:47:34', 'acsadmin', '2023-02-20 15:49:05', 'acsadmin'),
(145, 'เดอะ รอยัล  ศาลาแดง', 'The Royal Saladaeng', 4, 'ถนนศาลาแดง  กรุงเทพมหานคร\r\n', 'Saladaeng Road, Bangkok', 103, 14, 27, 17, 3, 1300, 24498, 'อาคารชุดพักอาศัยสูง 29 ชั้น (ไม่มีชั้นใต้ดิน)\r\nจำนวนห้องชุดที่พักอาศัย จำนวน 71 ยูนิต\r\nพร้อมที่จอดรถ\r\n', '29-storey residential condominium (no basement)\r\nNumber of residential units: 71 units\r\nwith parking', '[\"the royal saladaeng-63f33b3d326d8.jpg\",\"the royal saladaeng-63f33b3d329a5.jpg\"]', '0', '2550', '1', 'upload image', 'authorized', NULL, '2023-02-20 16:18:54', 'acsadmin', '2023-02-20 16:19:57', 'acsadmin'),
(146, 'คอนโด วิลเชอร์ สุขุมวิท 22  ', 'Condo Wilshire Sukhumvit 22 ', 4, 'ถนนสุขุมวิท 22  กรุงเทพมหานคร\r\n', 'Sukhumvit 22 Road, Bangkok', 104, 14, 29, 17, 3, 400, 22500, 'อาคารคอนโดมิเนียมพักอาศัย โครงสร้างคอนกรีตเสริม	\r\nเหล็กสูง 23 ชั้น (ไม่มีชั้นใต้ดิน) จำนวน 1 อาคาร\r\n', 'residential condominium building reinforced concrete structure\r\n23-storey steel (no basement), 1 building', '[\"condo wilshire sukhumvit 22 -63f6f345129c9.jpg\",\"condo wilshire sukhumvit 22 -63f6f34512c36.jpg\"]', '2547', '2549', '1', 'upload image', 'authorized', NULL, '2023-02-23 11:48:53', 'acsadmin', '2023-02-23 12:01:57', 'acsadmin'),
(147, 'พิพัฒน์สาทร อพาร์ทเมนต์', 'Pipat Sathorn Apartment', 4, 'ถนนสีลม  กรุงเทพมหานคร\r\n', 'Silom Road, Bangkok', 105, 14, 27, 17, 3, 100, 8000, 'อาคารพักอาศัย สูง 8 ชั้น โครงการประกอบด้วยพื้นที่\r\nชั้นที่ 1 เป็นพื้นที่จอดรถ พื้นที่ชั้น 2 ถึงชั้น 7 เป็นยูนิต\r\nที่พักอาศัย\r\n', '8-storey residential building. The project consists of areas\r\nThe 1st floor is the parking area, the 2nd floor to the 7th floor \r\nare units.accommodation', '[\"pipat sathorn apartment-63f6f62da5abe.jpg\"]', '0', '2549', '1', 'upload image', 'authorized', NULL, '2023-02-23 12:13:57', 'acsadmin', '2023-02-23 12:14:21', 'acsadmin'),
(148, 'พี.เอส. เรสซิเด้นท์', 'PS Residence', 4, 'ถนนสุขุมวิท  กรุงเทพมหานคร\r\n', 'Sukhumvit Road, Bangkok', 106, 14, 29, 17, 3, 200, 1000, 'อาคารที่พักอาศัย สูง 8 ชั้นและ 1 ชั้นใต้ดิน\r\n\r\n', 'Residential building, 8 floors and 1 basement\r\n', '[\"ps residence-63f6fca41a3b2.jpg\"]', '0', '2549', '1', 'upload image', 'authorized', NULL, '2023-02-23 12:41:29', 'acsadmin', '2023-02-23 12:41:56', 'acsadmin'),
(149, 'หัวหิน บลู ลากูน คอนโดมีเนียม ', 'Hua Hin Blue Lagoon Condominiums ', 4, 'อำเภอชะอำ  จังหวัดเพชบุรี\r\n', 'Cha-am District, Phetchaburi Province', 107, 14, 27, 17, 3, 600, 19980, 'คอนโดมิเนียมพักอาศัย จำนวน 108 ยูนิค 	\r\nและบ้านพักบนเกาะ ( Island Villas ) ทั้ง	\r\nแบบแยกระดับและแบบ 2 ชั้น จำนวน 37 หลัง \r\n', '108 unique residential condominiums and island villas, both\r\nSplit-level and 2-storey, totaling 37 houses', '[\"hua hin blue lagoon condominiums -63f6fec08b277.jpg\"]', '0', '2549', '1', 'upload image', 'authorized', NULL, '2023-02-23 12:49:35', 'acsadmin', '2023-02-23 12:50:56', 'acsadmin'),
(150, 'ลา วี ออง โรส เพลส', 'La Vie En Rose Place', 4, 'ซ.สุขุมวิท 36 กรุงเทพมหานคร', 'Soi Sukhumvit 36, Bangkok', 108, 10, 23, 18, 3, 531, 19896, 'อาคารคอนโดมิเนียมคอนกรีตเสริมเหล็กสูง 7 ชั้น 	\r\nและชั้นใต้ดิน 2 ชั้น จำนวน 2 อาคาร มีจำนวน 	\r\nห้องชุด 78 ห้อง จอดรถได้ 144 คัน\r\n', '7-storey reinforced concrete condominium building \r\nand 2 basement floors, 2 buildings with 78 units, 144 parking spaces', '[\"la vie en rose place-63f705e5cd1f5.jpg\",\"la vie en rose place-63f705e5cd649.jpg\"]', '0', '2549', '1', 'upload image', 'authorized', NULL, '2023-02-23 13:20:14', 'acsadmin', '2023-02-23 13:21:25', 'acsadmin'),
(151, 'โซฟิเทล เรสซิเด้น อโศก', 'Sofitel Residence Asoke', 4, 'ถนนสุขุมวิท กรุงเทพมหานคร', 'Sukhumvit Road, Bangkok', 109, 14, 27, 17, 3, 378, 33580, 'อาคารพักอาศัยสูง 29  ชั้นและอาคารสูง 14 ชั้น\r\nซึ่งอยู่บนฐานเดียวกัน โดยมีชั้นใต้ดินจำนวน 1 ชั้น\r\n', '29-storey residential building and 14-storey building\r\nwhich is on the same base It has 1 basement floor.', '[\"sofitel residence asoke-63f708b715046.jpg\"]', '0', '2548', '1', 'upload image', 'authorized', NULL, '2023-02-23 13:31:31', 'acsadmin', '2023-02-23 13:33:27', 'acsadmin'),
(152, 'บริษัท พลัส พร็อพเพอร์ตี้ พาร์ทเนอร์ จำกัด', 'Plus Property Partner Co., Ltd', 4, 'ถนนสุขุมวิท กรุงเทพมหานคร\r\n', 'Sukhumvit Road, Bangkok', 110, 14, 27, 17, 3, 470, 31950, 'อาคารพักอาศัยสูง 17 ชั้น จำนวน 2 อาคาร 	\r\nฐานเดียวกัน รวม 383 ยูนิต\r\n', '17-storey residential building, 2 buildings on the same base, \r\ntotaling 383 units', '[\"plus property partner co., ltd-63f874644f73c.jpg\"]', '0', '2548', '1', 'upload image', 'authorized', NULL, '2023-02-24 14:18:09', 'acsadmin', '2023-02-24 15:25:08', 'acsadmin'),
(153, 'คอนโด สุขุมวิท พลัส', 'Condo Sukhumvit Plus', 4, 'ถนนสุขุมวิท แขวงพระโขนง เขตคลองเตย กรุงเทพมหานคร ', 'Sukhumvit Road, Phra Khanong Subdistrict, Khlong Toei District, Bangkok', 110, 14, 27, 17, 3, 470, 31950, 'อาคารพักอาศัยสูง 17 ชั้น จำนวน 2 อาคาร 	\r\nฐานเดียวกัน รวม 383 ยูนิต\r\n', '17-storey residential building, 2 buildings on the same base, \r\ntotaling 383 units\r\n', '[\"condo sukhumvit plus-63f866a1d9852.jpg\"]', '0', '2548', '1', 'upload image', 'authorized', NULL, '2023-02-24 14:24:37', 'acsadmin', '2023-02-24 14:26:25', 'acsadmin'),
(154, 'บีที เรสซิเด้นท์', 'BT Residence', 4, '39 ถ.สุขุมวิท แขวงคลองเตย เขตคลองเตย กรุงเทพมหานคร 10110', '39 Sukhumvit Rd, Khwaeng Khlong Toei, Khet Khlong Toei,\r\nBangkok10110', 111, 14, 27, 17, 3, 229, 21000, 'อาคารพักอาศัยเป็นอาคารคอนกรีตเสริมเหล็กสูง 27 ชั้น จำนวน 1 อาคาร, งานถนน, งานทางลาดและลานจอดรถ,งานระบบไฟฟ้าและสื่อสาร, งานระบบประปา-สุขาภิบาล, งานระบบปรับอากาศและระบายอากาศ, งานระบบลิฟท์\r\n', 'The residential building is a 27-storey reinforced concrete building, 1 building, road work, ramp work and parking lot, electrical and communication system work, waterworks - sanitation system, air conditioning and ventilation system work, elevator system work.', '[\"bt residence-63f871e99855d.jpg\",\"bt residence-63f871e9988b4.jpg\"]', '2546', '2548', '1', 'upload image', 'authorized', NULL, '2023-02-24 15:06:41', 'acsadmin', '2023-02-24 15:14:33', 'acsadmin'),
(155, 'พลัส 67 คอนโดมิเนียม', 'Plus 67 Condominium', 4, 'ถนนสุขุมวิท 67 (ศรีจันทร์)  กรุงเทพมหานคร\r\n', 'Sukhumvit 67 Road (Si Chan), Bangkok', 110, 14, 27, 17, 3, 127, 9998, 'อาคารห้องพักคอนกรีตเสริมเหล็กสูง 9 ชั้น     \r\nจำนวนห้อง 121 ยูนิต\r\n', '9-storey reinforced concrete room building\r\n Number of rooms 121 units', NULL, '0', '2548', '1', 'create project', 'authorized', NULL, '2023-02-24 15:23:07', 'acsadmin', '2023-02-24 15:23:07', 'acsadmin'),
(156, 'เดอะ แกรนด์ เศรษฐีวรรณ', 'The Grand Sethiwan', 4, '82 สุขุมวิท 24 แขวงคลองตัน เขตคลองเตย กรุงเทพมหานคร 10110', '82 Sukhumvit 24, Khlong Tan, Khlong Toei, Bangkok 10110', 110, 14, 27, 17, 3, 470, 31950, 'อาคารพักอาศัยสูง 17 ชั้น จำนวน 2 อาคาร 	ฐานเดียวกัน รวม 383 ยูนิต\r\n', '17-storey residential building, 2 buildings on the same base, \r\ntotaling 383 units', '[\"the grand sethiwan-63f87cd0b00e2.jpg\"]', '0', '2548', '1', 'upload image', 'authorized', NULL, '2023-02-24 15:59:59', 'acsadmin', '2023-02-24 16:01:04', 'acsadmin'),
(157, 'เมธวนนท์ แมเนอร์', 'Methvanont Manor', 4, '908 ซอย สุขุมวิท 50 แขวง พระโขนง เขต คลองเตย กรุงเทพมหานคร 10110 ', '908 Soi Sukhumvit 50, Phra Khanong Subdistrict, Khlong Toei District, Bangkok 10110', 112, 14, 27, 17, 3, 200, 10000, 'อาคารพักอาศัยสูง 6 ชั้น จำนวน  1 อาคาร\r\n', '6-storey residential building, 1 building', '[\"methvanont manor-63f8877e7a9ee.jpg\"]', '0', '2547', '1', 'upload image', 'authorized', NULL, '2023-02-24 16:45:35', 'acsadmin', '2023-02-24 16:46:38', 'acsadmin'),
(158, 'วรจักร  คอมเพล็กซ์', 'Worachak Complex', 4, 'เขตป้อมปราบศัตรูพ่าย กรุงเทพมหานคร', 'Pom Prap Sattru Phai Bangkok', 113, 14, 27, 17, 3, 400, 35000, 'ประกอบด้วยอาคารร้านค้า สำนักงาน ที่พักอาศัย	สูง 24 ชั้น \r\nและชั้นใต้ดิน 1 ชั้นจำนวน 1 หลัง\r\n', 'It consists of a 24-storey residential office building \r\nand 1 basement floor.', '[\"worachak complex-63f889efd9938.jpg\"]', '0', '2541', '1', 'upload image', 'authorized', NULL, '2023-02-24 16:56:35', 'acsadmin', '2023-02-24 16:57:03', 'acsadmin'),
(159, 'บ้านแสนสราญ', 'Baan Sansaran', 4, 'ซอย หัวหิน 87 ตำบล หนองแก อำเภอหัวหิน ประจวบคีรีขันธ์ 77110', 'Soi Hua Hin 87, Nong Kae Subdistrict, Hua Hin District, \r\nPrachuap Khiri Khan 77110', 114, 14, 27, 17, 3, 535, 57896, 'อาคารชุดที่พักอาศัยคอนกรีตเสริมเหล็กสูง 4 ชั้น 	\r\nจำนวน 10 หลัง และอาคารสูง 6 ชั้น มีชั้นใต้ดิน 1 ชั้น	\r\nสำหรับเป็นที่จอดรถ จำนวน 1 หลัง\r\n', '10 4-storey reinforced concrete residential buildings \r\nand 1 6-storey building with 1 basement for parking.', '[\"baan sansaran-63f88c0c23d8f.jpg\"]', '0', '2541', '1', 'upload image', 'authorized', NULL, '2023-02-24 17:04:55', 'acsadmin', '2023-02-24 17:06:04', 'acsadmin'),
(160, 'ตรีทศ ซิตี้ มารีน่า', 'Tridhos City Marina', 4, '1867 ถนนเจริญนคร แขวงบางลำภูล่าง เขตคลองสาน กรุงเทพมหานคร 10600. ', '1867 Charoennakorn Road, Bang Lamphu Lang Subdistrict, Khlong San District, Bangkok 10600.', 115, 20, 21, 12, 3, 2000, 86000, 'กลุ่มอาคารชุดพักอาศัยคนกรีตเสริมเหล็กรวม 3 อาคาร 	\r\nได้แก่อาคารตรีทศ สูง 31 ชั้น อาคารซิตี้ สูง 27 ชั้น \r\nและอาคารมารีน่า สูง 22 ชั้น (รวมชั้นใต้ดิน)\r\n', 'A group of 3 steel-reinforced concrete residential buildings, including Tri Thot Tower, 31 floors high, City Tower, 27 floors high.\r\nand a 22-storey Marina building (including the basement)', '[\"tridhos city marina-63f88ea7c7ae4.jpg\",\"tridhos city marina-63f88ea7c7c32.jpg\"]', '0', '2536', '1', 'upload new image', 'authorized', NULL, '2023-02-24 17:14:22', 'acsadmin', '2023-02-24 17:17:11', 'acsadmin'),
(161, 'General Foods Poultry (Thailand) Co.,Ltd. ', 'General Foods Poultry (Thailand) Co.,Ltd. ', 1, 'ถ.เทพารักษ์ จ.สมุทรปราการ\r\n', 'Thepharak Road, Samut Prakan Province', 116, 2, 1, 8, 3, 60, 6000, 'อาคารคอนกรีตเสริมเหล็กชั้นเดียว\r\n', 'One-story reinforced concrete building', '[\"general foods poultry (thailand) co.,ltd. -641a784573711.jpg\"]', '2525', '0', '1', 'update project', 'authorized', NULL, '2023-03-22 10:37:47', 'acsadmin', '2023-03-22 10:40:16', 'acsadmin');
INSERT INTO `project` (`project_id`, `project_name_th`, `project_name_en`, `project_category`, `project_location_th`, `project_location_en`, `project_owner`, `project_scope`, `project_type`, `project_department`, `project_status`, `project_value`, `project_area`, `project_description_th`, `project_description_en`, `project_image`, `project_year_of_commencement`, `project_year_of_completion`, `project_active`, `project_action`, `project_reviewstatus`, `project_remarkstatus`, `created_at`, `user_created`, `updated_at`, `user_updated`) VALUES
(162, 'Paper Machine 3 Project (Converting Plant)', 'Paper Machine 3 Project (Converting Plant)', 1, 'ถ.คลองรั้ง - ปราจีนบุรี ต.ท่าตูม อ.ศรีมหาโพธิ จ.ปราจีนบุรี\r\n', 'Khlong Rang - Prachin Buri Road, Tha Tum Subdistrict, Si Maha Phot District\r\nPrachin Buri Province', 117, 19, 24, 16, 3, 300, 13000, 'อาคารโรงงาน คลังสินค้า และสำนักงาน\r\n', 'Factory, warehouse and office buildings', '[\"paper machine 3 project (converting plant)-641a7b181ce93.jpg\"]', '2550', '0', '1', 'upload image', 'authorized', NULL, '2023-03-22 10:50:12', 'acsadmin', '2023-03-22 10:50:48', 'acsadmin'),
(163, 'SUS-Cold Rolling Mill Complex ', 'SUS-Cold Rolling Mill Complex ', 1, '9 ซ.จี 5 ถ.ปกรณ์สงเคราะห์ราษฎร์ ต.ห้วยโป่ง อ.เมือง จ.ระยอง', '9 Soi G 5, Pakorn Songkhro Rat Road, Huai Pong Subdistrict, Mueang District, Rayong Province', 34, 2, 1, 8, 3, 400, 60000, 'อาคารสำนักงาน คลังสินค้าและคลังวัตถุดิบ โครงการประกอบด้วย\r\n				1) อาคารสำนักงาน 4 ชั้น จำนวน 1 หลัง\r\n				2) อาคารสำนักงาน 2 ชั้น จำนวน 1 หลัง\r\n				3) อาคารโรงอาหาร 1 ชั้น จำนวน 1 หลัง\r\n				4) พื้นที่ลานจอดรถขนาด 4,000 ตารางเมตร\r\n				5) อาคารคลังสินค้า Packing & Shipping Yard จำนวน 1 หลัง\r\n				6) คลังวัตถุดิบ Hot Coil Yard จำนวน 1 Yard\r\n				7) อาคาร Warehouse จำนวน 1 หลัง\r\n				ได้มีการจัดผังบริเวณ ของกลุ่มอาคารให้มีความสอดคล้องกับการใช้งาน และ มีการจัดภูมิทัศน์ของบริเวณทั้งหมด เพื่อให้โครงการมี	ความร่มรื่นสวยงาม\r\n', 'office building warehouse and raw material warehouse The project consists of\r\n1) One 4-storey office building\r\n2) One 2-storey office building\r\n3) 1-storey cafeteria building, 1 building\r\n4) 4,000 square meters of parking space\r\n5) 1 packing & shipping yard warehouse building\r\n6) Raw Material Warehouse Hot Coil Yard 1 Yard\r\n7) 1 warehouse building\r\nThe area has been arranged. of the building group to be consistent with the usage and the landscape of the entire area so that the project has beautiful shady', '[\"sus-cold rolling mill complex -641a7faa87497.jpg\"]', '0', '0', '1', 'upload image', 'authorized', NULL, '2023-03-22 11:09:47', 'acsadmin', '2023-03-22 11:10:18', 'acsadmin'),
(164, 'Texchem Factory Project ', 'Texchem Factory Project ', 1, 'นิคมอุตสาหกรรมบางปะอิน อ.บางปะอิน จ.พระนครศรีอยุธยา', 'Bang Pa-In Industrial Estate, Bang Pa-In District, Phra Nakhon Si Ayutthaya Province', 119, 19, 28, 16, 4, 0, 8075, 'โรงงานผลิตบรรจุภัณฑ์พลาสติก ก่อสร้างบนที่ดินขนาด 10 ไร่ 					ประกอบด้วย \r\n1)	งานก่อสร้างอาคารใหม่ 2 อาคาร ได้แก่ อาคารสำนักงานขนาด 1,500 ตารางเมตร และอาคารผลิตและโกดังขนาด 4,400 ตารางเมตร \r\n2)	งานปรับปรุงอาคารผลิตและโกดังเดิมขนาด 2,175 ตารางเมตร\r\n', 'plastic packaging factory Construction on 10 rai of land consisting of\r\n1) Construction of 2 new buildings, namely an office building with an area of 1,500 square meters and a production and warehouse building with an area of 4,400 square meters.\r\n2) Renovation of the existing production building and warehouse with the size of 2,175 square meters.', '[\"texchem factory project -641a815c7b9da.jpg\"]', '2550', '0', '1', 'upload image', 'authorized', NULL, '2023-03-22 11:17:04', 'acsadmin', '2023-03-22 11:17:32', 'acsadmin'),
(165, 'Unisia Jecs(Thailand) Phase 3-4 Factory ', 'Unisia Jecs(Thailand) Phase 3-4 Factory ', 1, 'นิคมอุตสาหกรรม เกตเวย์ซิตี้ จ.ฉะเชิงเทรา', 'Gateway City Industrial Estate, Chachoengsao Province', 120, 2, 1, 8, 3, 300, 6520, 'ประกอบด้วยอาคารโรงอาหาร/อาคารโรงงาน \r\nอาคาร Warehouse / อาคาร Waste Treatment \r\nและ Parking Lot มีหลังคาสำหรับจอดรถยนต์ได้\r\nประมาณ 8 คัน\r\n', 'Consisting of a canteen building/factory building\r\nWarehouse / Waste Treatment Building\r\nAnd the Parking Lot has a roof for parking cars.\r\nabout 8 cars', '[\"unisia jecs(thailand) phase 3-4 factory -6423c2e88ea23.jpg\"]', '0', '0', '1', 'upload image', 'authorized', NULL, '2023-03-29 11:46:39', 'acsadmin', '2023-03-29 11:47:36', 'acsadmin'),
(166, 'โครงการขยายกำลังผลิต  บริษัท ปูนซิเมนต์ไทย จำกัด', 'capacity expansion project The Siam Cement Company Limited', 1, 'จังหวัดสระบุรี\r\n', 'Saraburi Province', 121, 2, 1, 8, 3, 0, 12600, 'กลุ่มอาคาร ค.ส.ล. ประกอบด้วย Cement Silos \r\nหอถังน้า, Raw Mill Hoppers, Bucket Elevator', 'Group of reinforced concrete buildings consisting of Cement Silos\r\nWater Tower, Raw Mill Hoppers, Bucket Elevator', '[\"capacity expansion project the siam cement company limited-6423da44b02e6.jpg\"]', '0', '0', '1', 'upload image', 'authorized', NULL, '2023-03-29 13:26:46', 'acsadmin', '2023-03-29 13:27:16', 'acsadmin'),
(167, 'โรงงาน บริษัท ไทย ซี อาร์ ที จำกัด ', 'Factory of Thai CRT Co., Ltd.', 1, 'จังหวัดสระบุรี', 'Saraburi Province', 122, 2, 1, 8, 3, 0, 46600, 'อาคารโรงงานคอนกรีตเสริมเหล็ก\r\n', 'reinforced concrete factory building', '[\"factory of thai crt co., ltd.-6423dbbd7bea8.jpg\"]', '0', '0', '1', 'upload image', 'authorized', NULL, '2023-03-29 13:32:57', 'acsadmin', '2023-03-29 13:33:33', 'acsadmin');

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE `project_category` (
  `pcategory_id` int(11) NOT NULL,
  `pcategory_name_th` varchar(255) NOT NULL,
  `pcategory_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_category`
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
-- Table structure for table `project_leader`
--

CREATE TABLE `project_leader` (
  `leader_id` int(11) NOT NULL,
  `leader_name` varchar(100) NOT NULL,
  `leader_position` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_owner`
--

CREATE TABLE `project_owner` (
  `owner_id` int(11) NOT NULL,
  `owner_name_th` varchar(255) NOT NULL,
  `owner_name_en` varchar(255) NOT NULL,
  `owner_active` enum('1','0') NOT NULL DEFAULT '0',
  `owner_action` varchar(50) NOT NULL,
  `owner_reviewstatus` varchar(50) DEFAULT NULL,
  `owner_remarkstatus` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_owner`
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
(33, 'บริษัท ซี.พี. ค้าปลีกและการตลาด จำกัด', 'RETAILING AND MARKETING COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-19 10:25:06', 'acsadmin', NULL, NULL),
(34, 'บริษัท สยาม ยูไนเต็ด สตีล (1995)  จำกัด', 'SIAM UNITED STEEL (1995) COMPANY LIMITED.', '1', 'create project owner', 'authorized', NULL, '2023-01-20 17:24:52', 'acsadmin', '2023-01-20 17:24:52', 'acsadmin'),
(35, ' บริษัท  อลิอันซ์  เรียลตี้ จำกัด', 'ALLIANCE REALTY CO.,LTD.', '1', 'create project owner', 'authorized', NULL, '2023-01-20 17:31:08', 'acsadmin', '2023-01-20 17:31:08', 'acsadmin'),
(36, 'บริษัท วิไลลักษณ์ ดีเวลลอปเมนท์ จำกัด', 'WILAILUCK DEVELOPMENT CO.,LTD.', '1', 'create project owner', 'authorized', NULL, '2023-01-20 18:47:54', 'acsadmin', '2023-01-20 18:47:54', 'acsadmin'),
(37, 'บริษัท  นารายณ์โฮเต็ล จำกัด', 'NARAI HOTEL COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-20 19:02:59', 'acsadmin', '2023-01-20 19:02:59', 'acsadmin'),
(38, ' บริษัท หยี่เต้ง ภูเก็ต รีสอร์ท จำกัด', 'JEETENG PHUKET COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-20 19:09:24', 'acsadmin', '2023-01-20 19:09:24', 'acsadmin'),
(39, 'รอเติมข้อมูล', 'waiting for information', '1', 'create project owner', 'authorized', NULL, '2023-01-20 20:25:19', 'acsadmin', '2023-01-20 20:25:19', 'acsadmin'),
(40, 'บริษัท  พฤกษา เรียลเอสเตท จำกัด  (มหาชน)', 'Preuksa Real Estate Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-20 20:30:20', 'acsadmin', '2023-01-20 20:30:20', 'acsadmin'),
(41, 'บริษัท  ศิวยาธร จำกัด', 'SIVAYATORN COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-20 20:35:21', 'acsadmin', '2023-01-20 20:35:21', 'acsadmin'),
(42, 'บริษัท  สุวรรณ เอสเตท จำกัด', 'SUWAN ESTATE COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-20 20:41:41', 'acsadmin', '2023-01-20 20:41:41', 'acsadmin'),
(43, 'บริษัท  มณียาเรียลตี้  จำกัด', 'MANEEYA REALTY COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-20 20:48:16', 'acsadmin', '2023-01-20 20:48:16', 'acsadmin'),
(44, 'บริษัท  ดิเอราวัณ กรุ๊ป จำกัด (มหาชน)', 'The Erawan Group Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-20 21:04:41', 'acsadmin', '2023-01-20 21:04:41', 'acsadmin'),
(45, 'บริษัท  พันวาบีช พร๊อพเพอร์ตี้ส์ จำกัด', 'PANWA BEACH PROPERTIES COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-20 21:11:49', 'acsadmin', '2023-01-20 21:11:49', 'acsadmin'),
(46, 'บริษัท  เดอะ เรนทรี โฮเท็ล จำกัด', 'RAINTREE HOTEL CO., LTD.', '1', 'create project owner', 'authorized', NULL, '2023-01-20 21:17:40', 'acsadmin', '2023-01-20 21:17:40', 'acsadmin'),
(47, 'บริษัท  เคเอส รีสอร์ท แอนด์ สปา จำกัด', 'K.S.SAND AND SEA COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-20 21:53:02', 'acsadmin', '2023-01-20 21:53:02', 'acsadmin'),
(48, 'บริษัท รวิวาริน รีสอร์ทแอนด์สปา จำกัด และบริษัท มัช-มอร์ แอ็คเซซโซรี่ จำกัด', 'Rawi Warin Resort and Spa Co., Ltd. and Much-More Accessories Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-20 21:58:40', 'acsadmin', '2023-01-20 21:58:40', 'acsadmin'),
(49, 'บริษัท  รามาแลนด์ ดีเวลลอปเมนต์ จำกัด', 'RAMALAND DEVELOPMENT CO.,LTD.', '1', 'create project owner', 'authorized', NULL, '2023-01-20 22:18:04', 'acsadmin', '2023-01-20 22:18:04', 'acsadmin'),
(50, 'บริษัท  รอยัล การ์เด้น รีสอร์ท จำกัด', 'Royal Garden Resort Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-24 07:24:45', 'acsadmin', '2023-01-24 07:24:45', 'acsadmin'),
(51, ' บริษัท เอ อาร์ โฮลดิ้ง จำกัด', 'AR Holding Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-24 07:31:11', 'acsadmin', '2023-01-24 07:31:11', 'acsadmin'),
(52, 'สำนักงานเลขาธิการสภาผู้แทนราษฎร', 'the secretariat of the house of representatives', '1', 'create project owner', 'authorized', NULL, '2023-01-24 07:42:34', 'acsadmin', '2023-01-24 07:42:34', 'acsadmin'),
(53, 'บริษัท วิริยะพันธุ์ โฮลดิ้ง จำกัด', 'VIRIYAHBHUN HOLDINGS COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-24 09:21:26', 'acsadmin', '2023-01-24 09:21:26', 'acsadmin'),
(54, 'กระทรวงการต่างประเทศ', ' Ministry of Foreign Affairs of the Kingdom of Thailand.', '1', 'create project owner', 'authorized', NULL, '2023-01-24 09:37:08', 'acsadmin', '2023-01-24 09:37:08', 'acsadmin'),
(55, 'บริษัท โอสถสภา จำกัด', ' Osotspa Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-24 09:48:28', 'acsadmin', '2023-01-24 09:48:28', 'acsadmin'),
(56, 'ธนาคารกสิกรไทย จำกัด (มหาชน)', 'KASIKORNBANK PUBLIC. COMPANY LIMITED (Kbank)', '1', 'create project owner', 'authorized', NULL, '2023-01-24 10:40:36', 'acsadmin', '2023-01-24 10:40:36', 'acsadmin'),
(57, 'กรมสรรพสามิต', 'Excise Department ', '1', 'create project owner', 'authorized', NULL, '2023-01-24 10:58:55', 'acsadmin', '2023-01-24 10:58:55', 'acsadmin'),
(58, 'กรุงเทพมหานคร สำนักการโยธา', 'Bangkok Public Works Department', '1', 'create project owner', 'authorized', NULL, '2023-01-24 11:12:23', 'acsadmin', '2023-01-24 11:12:23', 'acsadmin'),
(59, 'องค์การกระจายเสียงและแพร่ภาพสารธารณะแห่งประเทศไทย', 'Thai Public Broadcasting Service; (TPBS) ', '1', 'create project owner', 'authorized', NULL, '2023-01-24 13:55:16', 'acsadmin', '2023-01-24 13:55:16', 'acsadmin'),
(60, 'ตลาดหลักทรัพย์แห่งประเทศไทย', 'The Securities Exchange of Thailand', '1', 'create project owner', 'authorized', NULL, '2023-01-24 14:08:41', 'acsadmin', '2023-01-24 14:08:41', 'acsadmin'),
(61, 'บริษัทกรุงเทพโทรทัศน์และวิทยุ จำกัด', 'Bangkok Broadcasting & T.V. Company Limited. ', '1', 'create project owner', 'authorized', NULL, '2023-01-25 09:37:57', 'acsadmin', '2023-01-25 09:37:57', 'acsadmin'),
(62, 'คณะวิทยาศาสตร์ มหาวิทยาลัยมหิดล', 'Faculty of Science Mahidol University', '1', 'create project owner', 'authorized', NULL, '2023-01-25 09:52:50', 'acsadmin', '2023-01-25 09:52:50', 'acsadmin'),
(63, 'บริษัท เกตเวย์ เอสเตท จำกัด', 'Gateway Estate Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-25 10:14:02', 'acsadmin', '2023-01-25 10:14:02', 'acsadmin'),
(64, 'บริษัท จัดการและพัฒนาทรัพยากรน้ำ 	ภาคตะวันออก จำกัด (มหาชน)', ' Eastern Water Resources Development and Management Public Company Limited.', '1', 'create project owner', 'authorized', NULL, '2023-01-25 10:20:15', 'acsadmin', '2023-01-25 10:20:15', 'acsadmin'),
(65, 'บริษัท รัชโยธิน อเวนิว แมนเนจเมนท์ จำกัด', 'MAJOR ONLINE CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-01-25 10:35:53', 'acsadmin', '2023-01-25 10:35:53', 'acsadmin'),
(66, 'บริษัท อิเมจิแมกซ์ จำกัด', ' IMAGIMAX COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-25 10:42:52', 'acsadmin', '2023-01-25 10:42:52', 'acsadmin'),
(67, 'การบินไทยจำกัด (มหาชน)', ' Thai Airways International Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-01-25 11:28:33', 'acsadmin', '2023-01-25 11:28:33', 'acsadmin'),
(68, 'สำนักงานศูนย์สร้างสรรค์งานออกแบบ', 'Thailand Creative and Design Center  (TCDC)', '1', 'create project owner', 'authorized', NULL, '2023-01-25 15:54:59', 'acsadmin', '2023-01-25 15:54:59', 'acsadmin'),
(69, ' บริษัท อมรินทร์พริ้นติ้ง แอนด์พับลิชซิ่ง จำกัด', 'Amarin Printing Co., Ltd. and Publishing Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-26 14:19:19', 'acsadmin', '2023-01-26 14:19:19', 'acsadmin'),
(70, 'Bashundhara City Development Ltd. (ประเทศบังคลาเทศ)', 'Bashundhara City Development Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-01-26 14:41:01', 'acsadmin', '2023-01-26 14:41:01', 'acsadmin'),
(71, 'กรมพัฒนาฝีมือแรงงาน', 'Department of Skill Development', '1', 'create project owner', 'authorized', NULL, '2023-01-26 14:53:14', 'acsadmin', '2023-01-26 14:53:14', 'acsadmin'),
(72, 'สถาบันบัณฑิตพัฒนบริหารศาสตร์', 'The National Institute of Development Administration-NIDA', '1', 'create project owner', 'authorized', NULL, '2023-01-26 15:01:42', 'acsadmin', '2023-01-26 15:01:42', 'acsadmin'),
(73, 'บริษัท ไทยวาพล่าซ่า จำกัด', 'THAI WAH PLAZA LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-26 15:12:42', 'acsadmin', '2023-01-26 15:12:42', 'acsadmin'),
(74, 'บริษัท  เอส สุขุมวิท 87 จำกัด ', 'S SUKHUMVIT 87 COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-26 15:45:00', 'acsadmin', '2023-01-26 15:45:00', 'acsadmin'),
(75, 'บริษัท  ไซมิส สุขุมวิท จำกัด', 'SIAMESE SUKHUMVIT CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-01-27 16:56:15', 'acsadmin', '2023-01-27 16:56:15', 'acsadmin'),
(76, 'บริษัท  ธนาคารกสิกรไทย จำกัด  (มหาชน)', 'KASIKORNBANK PUBLIC COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-01-27 17:28:42', 'acsadmin', '2023-01-27 17:28:42', 'acsadmin'),
(77, 'บริษัท  สยามนุวัตร จำกัด ', 'Siamnuwat Co., Ltd', '1', 'create project owner', 'authorized', NULL, '2023-01-27 17:36:19', 'acsadmin', '2023-01-27 17:36:19', 'acsadmin'),
(78, 'คุณรัตน์  โอสถานุเคราะห์', 'Mr. Rat Osatanukroh', '1', 'create project owner', 'authorized', NULL, '2023-02-02 11:20:50', 'acsadmin', '2023-02-02 11:20:50', 'acsadmin'),
(79, 'บริษัท ริชี่เพลส 2002 จำกัด (มหาชน)', 'RICHY PLACE 2002 PUBLIC COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-02-02 11:29:18', 'acsadmin', '2023-02-02 11:29:18', 'acsadmin'),
(80, 'บริษัท บ้านราชประสงค์ จำกัด (มหาชน)', 'Baan Rajprasong Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-02 11:38:43', 'acsadmin', '2023-02-02 11:38:43', 'acsadmin'),
(81, ' บริษัท เรียลแอสเสท ดีเวลลอปเม้นท์ จำกัด', 'REAL ASSET DEVELOPMENT CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-02-02 13:01:01', 'acsadmin', '2023-02-02 13:01:01', 'acsadmin'),
(82, ' บริษัท มายรีสอร์ท โฮลดิ้ง จำกัด', 'MY RESORT HOLDING CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-02-02 13:26:05', 'acsadmin', '2023-02-02 13:26:05', 'acsadmin'),
(83, 'บริษัท เดอะวิลล่า (หัวหิน) จำกัด ', 'THE VILLA (HUAHIN) CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-02-02 13:35:03', 'acsadmin', '2023-02-02 13:35:03', 'acsadmin'),
(84, ' บริษัท เสนา ดีเวลลอปเม้นท์ จำกัด (มหาชน)', 'Sena Development Public Co., Ltd', '1', 'create project owner', 'authorized', NULL, '2023-02-02 13:44:20', 'acsadmin', '2023-02-02 13:44:20', 'acsadmin'),
(85, ' บีเคเค แกรนด์ เอสเตท', 'BKK GRANG ESTATE CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-02-02 14:03:53', 'acsadmin', '2023-02-02 14:03:53', 'acsadmin'),
(86, ' บริษัท ศุภาลัย จำกัด (มหาชน)', 'SUPALAI PUBLIC COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-02-02 14:25:37', 'acsadmin', '2023-02-02 14:25:37', 'acsadmin'),
(87, 'บริษัท อิควิตี เรสซิเดนเชียล เจ้าพระยา จำกัด', 'EQUITY RESIDENTIAL CHAOPHYA CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-02-02 14:51:04', 'acsadmin', '2023-02-02 14:51:04', 'acsadmin'),
(88, 'บริษัท สยามสินทรัพย์พัฒนา จำกัด', 'SIAM PROPERTY DEVELOPMENT CO.,LTD.', '1', 'create project owner', 'authorized', NULL, '2023-02-08 17:52:03', 'acs@chivatip', '2023-02-08 17:52:03', 'acs@chivatip'),
(89, 'บริษัท ดั๊บเบิ้ล เอ เอทานอล จำกัด', 'Double A Ethanol Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-08 18:32:11', 'acsadmin', '2023-02-08 18:32:11', 'acsadmin'),
(90, ' บริษัท สินทรัพย์ช่างเหมาไทย จำกัด', 'Thai Contractors Asset Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-02-15 12:19:55', 'acsadmin', '2023-02-15 12:19:55', 'acsadmin'),
(91, ' บริษัท สยามนุวัตร จำกัด', 'Siamnuwat Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-15 12:37:33', 'acsadmin', '2023-02-15 12:37:33', 'acsadmin'),
(93, ' บริษัท ซิลเวอร์ คอยน์ จำกัด', 'SILVER COIN COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-02-15 13:17:34', 'acsadmin', '2023-02-15 13:17:34', 'acsadmin'),
(94, ' บริษัท เอสพีแคปปิตอล จำกัด', 'SP CAPITAL COMPANY LIMITED.', '1', 'create project owner', 'authorized', NULL, '2023-02-15 13:38:21', 'acsadmin', '2023-02-15 13:38:21', 'acsadmin'),
(96, 'บริษัท นารายณ์พร็อพเพอตี้ จํากัด', 'NARAI PROPERTY COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-02-15 14:45:49', 'acsadmin', '2023-02-15 14:45:49', 'acsadmin'),
(97, 'บริษัท เมเจอร์ ดีเวลลอปเม้นท์ จำกัด (มหาชน) ', 'MAJOR DEVELOPMENT PUBLIC COMPANY LIMITED  (MJD)', '1', 'create project owner', 'authorized', NULL, '2023-02-18 12:58:49', 'acsadmin', '2023-02-18 12:58:49', 'acsadmin'),
(98, 'บริษัท มนตรีอินเตอร์เนชั่นแนล จำกัด', 'Montri International Co Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-02-18 13:06:57', 'acsadmin', '2023-02-18 13:06:57', 'acsadmin'),
(99, ' บริษัท บ้านสุขุมวิท 14 จำกัด', 'BAAN SUKHUMVIT COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-02-19 14:45:48', 'acsadmin', '2023-02-19 14:45:48', 'acsadmin'),
(100, 'บริษัท อีสเทอร์น สตาร์ เรียล เอสเตท จำกัด (มหาชน)', 'Eastern Star Real Estate Public Co.,Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-02-19 15:07:19', 'acsadmin', '2023-02-19 15:07:19', 'acsadmin'),
(101, ' บริษัท เศรษฐีวรรณการเคหะ จำกัด', 'SETTHIWAN REALESTATE CO.,LTD.', '1', 'create project owner', 'authorized', NULL, '2023-02-19 15:17:11', 'acsadmin', '2023-02-19 15:17:11', 'acsadmin'),
(102, ' บริษัท วสุ 55 จำกัด', 'VASU 55 COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-02-19 15:35:34', 'acsadmin', '2023-02-19 15:35:34', 'acsadmin'),
(103, 'บริษัท ชาร์เตอร์ สแควร์ โฮลดิ้ง จำกัด', 'CHARTERED SQUARE HOLDING CO., LTD', '1', 'create project owner', 'authorized', NULL, '2023-02-20 15:59:12', 'acsadmin', '2023-02-20 15:59:12', 'acsadmin'),
(104, ' บริษัท รสา พร็อพเพอร์ตี้ ดีเวลลอปเม้นท์ จำกัด  	(มหาชน)', 'RASA Property Development Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-23 11:36:10', 'acsadmin', '2023-02-23 11:36:10', 'acsadmin'),
(105, 'บริษัท บ้านพิพัฒน์ จำกัด', 'Ban Phiphat Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-23 12:04:32', 'acsadmin', '2023-02-23 12:04:32', 'acsadmin'),
(106, ' บริษัท พี.เอส.แอสเซท ดีเวลลอปเม้นท์ จำกัด', 'P.S. ASSETS DEVELOPMENT CO.,LTD', '1', 'create project owner', 'authorized', NULL, '2023-02-23 12:32:17', 'acsadmin', '2023-02-23 12:32:17', 'acsadmin'),
(107, 'บริษัท แกรนด์ แอสเสท ดีเวลลอปเม้นท์ จำกัด (มหาชน)', 'Grande Asset Hotels And Property Public Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-23 12:44:20', 'acsadmin', '2023-02-23 12:44:20', 'acsadmin'),
(108, 'บริษัท เนชั่นแนลยูเนี่ยน จำกัด', 'NATIONAL UNION COMPANY LIMITED', '1', 'create project owner', 'authorized', NULL, '2023-02-23 13:04:25', 'acsadmin', '2023-02-23 13:04:25', 'acsadmin'),
(109, ' บริษัท ราชา โอเวอร์ซีส์ เทรดดิ้ง จำกัด', 'Raja Overseas Trading Co.,Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-02-23 13:26:30', 'acsadmin', '2023-02-23 13:26:30', 'acsadmin'),
(110, 'บริษัท พลัส พร็อพเพอร์ตี้ พาร์ทเนอร์ จำกัด', 'Plus Property Partner Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-02-24 14:14:15', 'acsadmin', '2023-02-24 14:14:15', 'acsadmin'),
(111, ' บริษัท รอยัล ดีเวลลอปเม้นท์ จำกัด', 'Royal Development Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-24 14:57:13', 'acsadmin', '2023-02-24 14:57:13', 'acsadmin'),
(112, ' บริษัท วี เอ็ม เจ พรอพเพอร์ตี้ จำกัด', 'V M J Property Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-02-24 16:02:59', 'acsadmin', '2023-02-24 16:02:59', 'acsadmin'),
(113, 'บริษัท ธนาคมและการพัฒนา จำกัด', 'Thanakom and Development Co., Ltd.', '1', 'update project owner', 'authorized', NULL, '2023-02-24 16:49:36', 'acsadmin', '2023-02-24 16:53:26', 'acsadmin'),
(114, ' บริษัท แสนสิริ จำกัด (มหาชน)', ' Sansiri Public Company Limited (SIRI)', '1', 'create project owner', 'authorized', NULL, '2023-02-24 16:58:58', 'acsadmin', '2023-02-24 16:58:58', 'acsadmin'),
(115, 'บริษัท โมเบลกส์ จำกัด', ' Moblex Company Limited', '1', 'create project owner', 'authorized', NULL, '2023-02-24 17:08:22', 'acsadmin', '2023-02-24 17:08:22', 'acsadmin'),
(116, 'general foods poultry (thailand) co. ltd.', 'general foods poultry (thailand) co. ltd.', '1', 'create project owner', 'authorized', NULL, '2023-03-22 10:31:59', 'acsadmin', '2023-03-22 10:31:59', 'acsadmin'),
(117, 'บริษัท ดั๊บเบิ้ล เอ (1991) จำกัด (มหาชน)', 'Double A (1991) Public Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-03-22 10:43:58', 'acsadmin', '2023-03-22 10:43:58', 'acsadmin'),
(118, 'บริษัท สยาม ยูไนเต็ด สตีล (1995) จำกัด', 'NS-SIAM UNITED STEEL CO., LTD.', '1', 'create project owner', 'authorized', NULL, '2023-03-22 11:06:55', 'acsadmin', '2023-03-22 11:06:55', 'acsadmin'),
(119, 'บริษัท เท็กซ์เคม - แพค (ไทยแลนด์) จำกัด', 'Texchem – Pack (Thailand) Co., Ltd.', '1', 'create project owner', 'authorized', NULL, '2023-03-22 11:13:41', 'acsadmin', '2023-03-22 11:13:41', 'acsadmin'),
(120, 'ยูนิเซีย เจคส์ (ประเทศไทย)', 'Unisia Jecs (Thailand) Co., Ltd', '1', 'create project owner', 'authorized', NULL, '2023-03-22 11:20:36', 'acsadmin', '2023-03-22 11:20:36', 'acsadmin'),
(121, 'บริษัท ปูนซิเมนต์ไทย จำกัด (มหาชน)', 'The Siam Cement Public Company Limited. (SCC)', '1', 'create project owner', 'authorized', NULL, '2023-03-29 13:21:06', 'acsadmin', '2023-03-29 13:21:06', 'acsadmin'),
(122, 'บริษัท ไทย ซี อาร์ ที จำกัด', ' THAI CRT CO., LTD', '1', 'create project owner', 'authorized', NULL, '2023-03-29 13:29:17', 'acsadmin', '2023-03-29 13:29:17', 'acsadmin');

-- --------------------------------------------------------

--
-- Table structure for table `project_proposal`
--

CREATE TABLE `project_proposal` (
  `proposal_id` int(11) NOT NULL,
  `proposal_ref` varchar(100) NOT NULL,
  `proposal_date` date NOT NULL,
  `proposal_subject` varchar(255) NOT NULL,
  `proposal_project` varchar(255) NOT NULL,
  `proposal_customer` varchar(100) NOT NULL,
  `proposal_cposition` varchar(100) DEFAULT NULL,
  `proposal_ccompany` varchar(100) NOT NULL,
  `proposal_introduction` text NOT NULL,
  `proposal_description` varchar(255) NOT NULL,
  `proposal_eventually` text NOT NULL,
  `proposal_projectleader` int(11) NOT NULL,
  `proposal_language` enum('TH','EN') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_scope`
--

CREATE TABLE `project_scope` (
  `scope_id` int(11) NOT NULL,
  `scope_name_th` varchar(255) NOT NULL,
  `scope_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_scope`
--

INSERT INTO `project_scope` (`scope_id`, `scope_name_th`, `scope_name_en`, `created_at`, `updated_at`) VALUES
(1, 'ออกแบบวิศวกรรมโครงสร้าง บริหารและควบคุมงานก่อสร้าง', 'Structural engineering', '2022-08-10 15:26:03', NULL),
(2, 'ออกแบบวิศวกรรมโครงสร้าง', 'Structural engineering design', '2022-08-10 15:26:03', '2023-01-15 08:24:38'),
(3, 'ออกแบบวิศวกรรมโครงสร้าง บริหารโครงการและควบคุมงานก่อสร้าง', 'structural engineering design Project management and construction supervision', '2022-08-10 15:34:21', '2023-01-24 07:38:48'),
(4, 'ควบคุมงานก่อสร้างอาคาร ตั้งแต่งานเสาเข็ม, โครงสร้าง, สถาปัตยกรรม, งานระบบต่างๆ ประสานงานการตกแต่งบาง', 'Construction management and supervision of the project', '2022-08-10 15:35:46', NULL),
(5, 'ออกแบบวิศวกรรมโครงสร้าง และควบคุมงานก่อสร้างเสาเข็ม', 'Structural engineering design and construction supervision of the piling work', '2022-08-10 15:35:46', NULL),
(6, 'บริหารและควบคุมงานก่อสร้าง', 'Construction management and supervision', '2022-10-26 23:32:44', NULL),
(7, 'ออกแบบงานโครงสร้าง  สถาปัตยกรรม และงานระบบ บริหารและควบคุมงานก่อสร้าง', 'Architectural structure design and system work. Construction management and supervision.', '2022-12-08 12:21:08', NULL),
(8, 'การออกแบบวิศวกรรมโยธา', 'civil engineering design', '2023-01-15 08:26:12', NULL),
(9, 'การออกแบบวิศวกรรมโครงสร้าง / การออกแบบวิศวกรรมโยธา', 'structural engineering design / civil engineering design', '2023-01-15 08:27:26', NULL),
(10, 'ออกแบบวิศวกรรมโครงสร้าง / ออกแบบวิศวกรรมงานระบบ / บริหารโครงการ / บริหารและควบคุมงานก่อสร้าง', 'Structural Engineering Design / System Engineering Design / Project Management /  Construction Management and Supervision', '2023-01-17 10:20:55', '2023-01-17 11:37:38'),
(11, 'ออกแบบสถาปัตยกรรม/ออกแบบวิศวกรรมโครงสร้าง 	ออกแบบวิศวกรรมงานระบบ 	บริหารและควบคุมการก่อสร้าง', 'Architectural Design/Structural Engineering Design system engineering design Construction management and supervision', '2023-01-17 15:27:29', NULL),
(12, 'ออกแบบสถาปัตยกรรมและวิศวกรรมโครงสร้าง 	ออกแบบวิศวกรรมงานระบบประกอบอาคาร', 'Architectural Design and Structural Engineering Building system engineering design', '2023-01-19 08:36:38', NULL),
(13, 'ออกแบบวิศวกรรมโครงสร้างและวิศวกรรมงานระบบ /บริหารและควบคุมงานก่อสร้าง', 'Structural Engineering Design and System Engineering /Construction management and supervision', '2023-01-20 16:22:01', NULL),
(14, 'บริหารและควบคุมการก่อสร้าง / บริหารโครงการและต้นทุน', 'Construction management and control / project and cost management', '2023-01-20 18:53:22', NULL),
(15, 'ที่ปรึกษาควบคุมต้นทุน ออกแบบสถาปัตยกรรม /วิศวกรรมโครงสร้าง / โยธา และวิศวกรรมระบบ,ประกอบอาคาร', 'cost control consultant architectural design / structural engineering / civil and system engineering, building assembly', '2023-01-20 19:42:45', NULL),
(16, 'บริหารโครงการ', 'project management', '2023-01-20 21:37:36', NULL),
(17, 'บริหารและควบคุมการก่อสร้างและควบคุมงานตกแต่งภายใน', 'Manage and supervise the construction and control of the interior work.', '2023-01-24 09:30:32', NULL),
(18, 'บริหารและควบคุมการก่อสร้าง / ออกแบบวิศวกรรมโครงสร้าง / โยธา', 'Construction management and control / structural / civil engineering design', '2023-01-24 14:02:16', NULL),
(19, 'ออกแบบสถาปัตยกรรม / วิศวกรรมโครงสร้าง งานระบบประกอบอาคาร / บริหารโครงการ /บริหารและควบคุมงานก่อสร้าง', 'Architectural Design / Structural Engineering Building system work / project management /Construction management and supervision', '2023-01-25 09:07:16', NULL),
(20, 'บริหารโครงการและต้นทุน / บริหารและควบคุมงานก่อสร้าง / ออกแบบวิศวกรรมโครงการ', 'Project and Cost Management / Construction Management and Supervision / Structural engineering design', '2023-01-26 14:13:16', '2023-01-26 14:34:42'),
(21, 'ที่ปรึกษาด้านงานวิศวกรรมคุณค่า / บริหารและควบคุมการก่อสร้าง', 'Value Engineering Consulting / Construction Management and Control', '2023-02-15 14:47:55', NULL),
(22, 'ตรวจทบทวนแบบรายละเอียด (Design Review)  / บริหารโครงการและควบคุมการก่อสร้าง', 'Detailed review (Design Review)  / Project management and construction supervision', '2023-02-19 15:10:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE `project_status` (
  `status_id` int(11) NOT NULL,
  `status_name_th` varchar(255) NOT NULL,
  `status_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`status_id`, `status_name_th`, `status_name_en`, `created_at`, `updated_at`) VALUES
(1, 'ยังไม่ดำเนินการ', 'pending', '2022-08-10 14:59:30', NULL),
(2, 'กำลังดำเนินการอยู่', 'inprogress ', '2022-08-10 14:59:30', NULL),
(3, 'ดำเนินการเสร็จสิ้น', 'success', '2022-08-10 14:59:42', NULL),
(4, 'ชะลอโครงการ', 'delay project', '2022-11-09 13:09:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE `project_type` (
  `type_id` int(11) NOT NULL,
  `type_name_th` varchar(255) NOT NULL,
  `type_name_en` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project_type`
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
(24, 'ผลงานออกแบบสถาปัตยกรรม/ออกแบบวิศวกรรมโครงสร้าง  ออกแบบระบบวิศวกรรมประกอบอาคาร 	บริหารและควบคุมการก่อสร้าง', 'Portfolio Architectural design/Structural engineering design system engineering design Construction management and supervision', '2023-01-17 15:28:26', '2023-01-22 12:07:38'),
(25, 'ผลงานออกแบบสถาปัตยกรรมและวิศวกรรมโครงสร้าง ออกแบบวิศวกรรมงานระบบประกอบอาคาร', 'Architectural design and structural engineering works Building system engineering design', '2023-01-19 08:37:40', NULL),
(26, 'ผลงานออกแบบวิศวกรรมโครงสร้างและวิศวกรรมงานระบบ  / บริหารและควบคุมงานก่อสร้าง', 'Structural engineering and system engineering design portfolio /Construction management and supervision', '2023-01-20 16:24:40', NULL),
(27, 'ผลงานบริหารและควบคุมงานก่อสร้าง / บริหารโครงการและต้นทุน', 'Project Management and Supervision of Construction / Project and Cost Management', '2023-01-20 18:55:21', NULL),
(28, 'ผลงานที่ปรึกษาควบคุมต้นทุน ออกแบบสถาปัตยกรรม /วิศวกรรมโครงสร้าง / โยธา และวิศวกรรมระบบ,ประกอบอาคาร', 'Portfolio Cost Control Consultant architectural design / structural engineering / civil and system engineering, building assembly', '2023-01-20 19:44:19', NULL),
(29, 'ผลงานที่ปรึกษาบริหารโครงการ / ผลงานบริหารและควบคุมงานก่อสร้าง', 'Portfolio of Project Management Consulting / Portfolio of Construction Management and Supervision', '2023-01-25 16:27:32', NULL),
(30, 'ผลงานออกแบบวิศวกรรมโครงสร้าง / บริหารและควบคุมงานก่อสร้างงานเสาเข็ม', 'Structural engineering design / Construction management and supervision of piling work', '2023-01-26 15:23:50', NULL),
(31, 'ผลงาน ที่ปรึกษาด้านงานวิศวกรรมคุณค่า / บริหารและควบคุมการก่อสร้าง', 'Portfolio Value Engineering Consultant / Construction Management and Supervision', '2023-02-15 14:49:20', NULL),
(32, 'ผลงานออกแบบวิศวกรรมโครงสร้าง / บริหารโครงการ และ ควบคุมการก่อสร้าง', 'Structural engineering design / project management and construction supervision', '2023-02-18 13:20:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `template_language` enum('TH','EN') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_detail`
--

CREATE TABLE `template_detail` (
  `tdetail_id` int(11) NOT NULL,
  `tdetail_template_id` int(11) NOT NULL,
  `tdetail_project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `user_email`, `user_firstname`, `user_lastname`, `user_mobilenumber`, `user_role`, `user_depid`, `created_at`, `updated_at`) VALUES
(1, 'acsadmin', '$2y$10$6xRUNFqz8pUVHRWz32aFC.u8LyvOJq5Q29f5c/RcLBPj08RSG5Bw2', 'acs@arunchaiseri.co.th', 'ACS', 'Admin', '1234', 'admin', '5', '2022-09-15 05:41:32', '2022-12-20 14:42:47'),
(2, 'acs@chivatip', '$2y$10$pJ2/dfyYHtyunGjmbaayq.utGt/3dye7cLUhycyC/IziGrInF9Fba', 'Chivatip@gmail.com', 'ชิวาทิพย์', 'ภู่งาม', '0819016563', 'user', '5', '2023-01-25 14:11:10', '2023-01-25 14:15:17');

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
-- Indexes for table `project_leader`
--
ALTER TABLE `project_leader`
  ADD PRIMARY KEY (`leader_id`);

--
-- Indexes for table `project_owner`
--
ALTER TABLE `project_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `project_proposal`
--
ALTER TABLE `project_proposal`
  ADD PRIMARY KEY (`proposal_id`);

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
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `pcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_leader`
--
ALTER TABLE `project_leader`
  MODIFY `leader_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_owner`
--
ALTER TABLE `project_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `project_proposal`
--
ALTER TABLE `project_proposal`
  MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_scope`
--
ALTER TABLE `project_scope`
  MODIFY `scope_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `project_status`
--
ALTER TABLE `project_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
