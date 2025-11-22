CREATE TABLE `cache` (`key` VARCHAR(255) NOT NULL, `value` TEXT NOT NULL, `expiration` INTEGER NOT NULL, PRIMARY KEY(`key`));

CREATE TABLE `cache_locks` (`key` VARCHAR(255) NOT NULL, `owner` VARCHAR(255) NOT NULL, `expiration` INTEGER NOT NULL, PRIMARY KEY(`key`));

CREATE TABLE `failed_jobs` (`id` INTEGER NOT NULL AUTO_INCREMENT, `uuid` VARCHAR(255) NOT NULL, `connection` TEXT NOT NULL, `queue` TEXT NOT NULL, `payload` TEXT NOT NULL, `exception` TEXT NOT NULL, `failed_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(`id`));

CREATE TABLE `job_batches` (`id` VARCHAR(255) NOT NULL, `name` VARCHAR(255) NOT NULL, `total_jobs` INTEGER NOT NULL, `pending_jobs` INTEGER NOT NULL, `failed_jobs` INTEGER NOT NULL, `failed_job_ids` TEXT NOT NULL, `options` TEXT, `cancelled_at` INTEGER, `created_at` INTEGER NOT NULL, `finished_at` INTEGER, PRIMARY KEY(`id`));

CREATE TABLE `jobs` (`id` INTEGER NOT NULL AUTO_INCREMENT, `queue` VARCHAR(255) NOT NULL, `payload` TEXT NOT NULL, `attempts` INTEGER NOT NULL, `reserved_at` INTEGER, `available_at` INTEGER NOT NULL, `created_at` INTEGER NOT NULL, PRIMARY KEY(`id`));

CREATE TABLE `migrations` (`id` INTEGER NOT NULL AUTO_INCREMENT, `migration` VARCHAR(255) NOT NULL, `batch` INTEGER NOT NULL, PRIMARY KEY(`id`));

CREATE TABLE `password_reset_tokens` (`email` VARCHAR(255) NOT NULL, `token` VARCHAR(255) NOT NULL, `created_at` DATETIME, PRIMARY KEY(`email`));
CREATE TABLE `users` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `role` VARCHAR(255) NOT NULL,
    `email_verified_at` DATETIME,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY(`id`)
);

CREATE TABLE `products` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `nutrients` VARCHAR(255) NOT NULL,
    `landType` VARCHAR(255) NOT NULL,
    `age` VARCHAR(255) NOT NULL,
    `condition` VARCHAR(255) NOT NULL,
    `price` INTEGER NOT NULL,
    `benefit` TEXT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `user_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE `sessions` (`id` VARCHAR(255) NOT NULL, `user_id` INTEGER, `ip_address` VARCHAR(255), `user_agent` TEXT, `payload` TEXT NOT NULL, `last_activity` INTEGER NOT NULL, PRIMARY KEY(`id`));



INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` VALUES (4,'2025_11_16_005358_create_products_table',1);
INSERT INTO users VALUES (1,'Admin','admin@gmail.com','admin','Admin',NULL,'$2y$12$K.kKfaGElwbl1rDM/vLS/OjaQ5WPCwQvPzJZGl569L/TjCcgC7fIq',NULL,'2025-11-18 14:20:51','2025-11-18 14:20:51');

INSERT INTO products VALUES (1,'CACLIUM CFPK','SiO2 83%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',360000,'Penggemburan dan penyuburan tanah, meningkatkan pertumbuhan akar, batang, daun, pembungaan, dan pembentukan buah','http://127.0.0.1:8000/images/1763478180.png',1,'2025-11-18 14:22:06','2025-11-18 15:03:00');
INSERT INTO products VALUES (2,'Calcium Granular','CaO 26%, CaCO3 47%, MgO 20%, K2O 10%, S 5%, SiO2 10%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',310000,'Menstabilkan pH tanah, perbanyakan nutrisi, dan menstabilkan pembuahan','http://127.0.0.1:8000/images/1763795312.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:08:32');
INSERT INTO products VALUES (3,'Calcium M 100 Powder','CaO 35%, CaCO3 61%, MgO 21%, K2O 6%, S 0.10%, Fe2O3 1882 mg/kg, CuO 2.80 mg/kg, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',210000,'Menetralkan pH tanah, memperbaiki struktur kimia tanah, dan meningkatkan bobot buah','http://127.0.0.1:8000/images/1763795361.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:09:21');
INSERT INTO products VALUES (4,'CRP PAUS','CaO 42%, CaCO3 86%, P2O5 5%, K2O 3%, S 5%, SiO2 2%, + Te/Micro','Lahan darat','10-15 tahun, 15-20 tahun','Buah Sehat atau Normal',260000,'Pupuk perbanyakan nutrisi tanah dan pembesaran buah','https://drive.google.com/uc?id=11ztugaQb7v7zWKW-XuxWsWPA90yNS6At',1,'2025-11-18 14:22:06','2025-11-18 14:22:06');
INSERT INTO products VALUES (5,'KSP PLUS 31','K2O 27%, P2O5 31%, Sodium Humat 2%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Tidak Sehat',610000,'Mempercepat perbaikan tanah, pertumbuhan perakaran, batang, dan pembesaran buah','/images/1763798887.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:08:07');
INSERT INTO products VALUES (6,'Magsul - Powder','MgO 26%, SiO2 4%, S 20%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Tidak Sehat',210000,'Metabolisme fosfat, respirasi tanaman, aktivitas enzim, dan fotosintesis','/images/1763798920.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:08:40');
INSERT INTO products VALUES (7,'Magsul - Granular','MgO 26%, SiO2 4%, S 20%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Tidak Sehat',230000,'Metabolisme fosfat, respirasi tanaman, aktivitas enzim, dan fotosintesis','/images/1763798956.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:09:16');
INSERT INTO products VALUES (8,'Magsili - Powder','MgO 24 %, SiO2 43 %, Al2O3 4.51 %, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',220000,'Menetralkan struktur tanah, perbaikan pertumbuhan tanaman dan pembesaran buah','/images/1763798790.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:06:30');
INSERT INTO products VALUES (9,'Magsili - Granular','MgO 24 %, SiO2 43 %, Al2O3 4.51 %, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',240000,'Menetralkan struktur tanah, perbaikan pertumbuhan tanaman dan pembesaran buah','/images/1763798991.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:09:51');
INSERT INTO products VALUES (10,'Nitroganik','N 20%, K2O 6%, S 15%, MgO 2%, CaO 15%, CaCO3 27%, SiO2 15%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',390000,'Mempercepat perbaikan pertumbuhan akar, batang, pelepah, daun, dan buah','/images/1763798587.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:05:37');
INSERT INTO products VALUES (11,'NPK 6-12-22','N2, P2O5, K2O, S, CaO, CaCO3, MgO, SiO2, + Te/Micro','Lahan gambut','<5 Tahun','Buah Sehat atau Normal',420000,'Menyeimbangkan unsur hara, meningkatkan ketahanan tanaman','/images/1763799032.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:10:32');
INSERT INTO products VALUES (12,'NPK 12-12-18','N2 12%, P2O5 12%, K2O 18%, MgO 3%, CaO 11%, CaCO3 19%, SiO2 6%, S 3%, + Te/Micro','Lahan gambut','<5 Tahun','Buah Sehat atau Normal & Sakit',440000,'Perbanyakan dan pembesaran buah','/images/1763799069.jpg',1,'2025-11-18 14:22:06','2025-11-22 08:11:09');
INSERT INTO products VALUES (13,'NPK 13-18-27','N2 13%, P2O5 8%, K2O 27%, MgO 3%, SiO2 6%, S 4%, CaO 10%, CaCO3 20%, + Te/Micro','Lahan darat','<5 Tahun','Buah Sehat atau Normal',470000,'Perbanyakan dan pembesaran buah','http://127.0.0.1:8000/images/1763797532.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:45:32');
INSERT INTO products VALUES (14,'NPK PLUS 12','N2 2%, P2O5 4%, K2O 6%, S 2%, CaO 34%, CaCO3 61%, MgO 19%, + Te/Micro','Lahan darat','<5 Tahun','Buah Sehat atau Normal',280000,'Pupuk perbanyakan nutrisi tanah dan pembesaran buah','/images/1763797622.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:47:02');
INSERT INTO products VALUES (15,'NPK PLUS 17','N2 2%, P2O5 4%, K2O 11%, S 2%, CaO 31%, CaCO3 56%, MgO 18%, + Te/Micro','Lahan berpasir','<5 Tahun','Buah Sehat atau Normal',310000,'Pupuk perbanyakan nutrisi tanah dan pembesaran buah','/images/1763797737.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:48:57');
INSERT INTO products VALUES (16,'NPK TRIPPLE 15','N2 15%, P2O5 15%, K2O 15%, MgO 8%, CaO 12%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',470000,'Menyeimbangkan unsur hara dan meningkatkan pertumbuhan tanaman','/images/1763797798.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:49:58');
INSERT INTO products VALUES (17,'PHOSUL','P2O5 21%, S 8%, MgO 10%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',410000,'Pupuk perbaikan tanah, pertumbuhan perakaran dan batang, serta menstabilkan pembuahan','/images/1763797862.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:51:02');
INSERT INTO products VALUES (18,'SUPER NITREA 2','N2, K2O, S, CaO, CaCO3, MgO, SiO2 / Zeolite, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Sehat atau Normal',390000,'Meningkatkan daya serap nutrisi tanah dan pertumbuhan akar','/images/1763797916.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:51:56');
INSERT INTO products VALUES (19,'SS/AMOPHOS','N2 16%, P2O5 20%, S 13%, SiO2 4%, + Te/Micro','Lahan gambut','<5 Tahun','Buah Tidak Sehat',480000,'Perbaikan pertumbuhan & peningkatan pembuahan','/images/1763797956.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:52:36');
INSERT INTO products VALUES (20,'ZKAL','S 15%, K2O 30%, MgO 13%, CaO 7%, CaCO3 12%, + Te/Micro','Semua jenis lahan','<5 Tahun','Buah Tidak Sehat',380000,'Pupuk perbaikan tanah, perbanyakan nutrisi, dan menstabilkan pembuahan','/images/1763797999.jpg',1,'2025-11-18 14:22:06','2025-11-22 07:53:19');
INSERT INTO sessions VALUES ('FtOnEKsxFm7dhBfiwrzh42xmPFQmM1eE2EP74oJm',1,'192.168.1.2','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoic01DeWhxZnhmOEQxeXFqRjJSbHZ1bGN5a25WdkpOdEM4VUtGSkFJMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly8xOTIuMTY4LjEuNDo4MDAwIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1763798006);
INSERT INTO sessions VALUES ('rKaWHGPVNnwcQbCD0wZoFmQrqNLIpsN1lTVrLq9Z',NULL,'192.168.1.4','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkxZMEI1YlZxNTBBNkdLVTJ4TFNFUlNFMXNqV0d6OHk3UHBEb2dwUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly8xOTIuMTY4LjEuNDo4MDAwIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1763797754);
INSERT INTO sessions VALUES ('tTGDo18EwA90XYk9D5nTrl3DGPuS7U2TMrqIQLE6',NULL,'192.168.1.6','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZkNXY1Q3VnNHZWdLcUcwUDRZZ2FFaDh4aHBHZ2xScVVjQThhNlRRcSI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly8xOTIuMTY4LjEuNDo4MDAwIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1763797198);
INSERT INTO sessions VALUES ('sESntTzyE18YFJXsb0oa74ZNy7LHm2qgAq95Cpdd',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS3BMV21rU1hsdWE4TkI3S2tDQVlrTTV0a29PTTY3R1g2Z1pVdnB3aSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319',1763800728);


CREATE UNIQUE INDEX `failed_jobs_uuid_unique` ON `failed_jobs` (`uuid`);
CREATE INDEX `jobs_queue_index` ON `jobs` (`queue`);
CREATE INDEX `sessions_last_activity_index` ON `sessions` (`last_activity`);
CREATE INDEX `sessions_user_id_index` ON `sessions` (`user_id`);
CREATE UNIQUE INDEX `users_email_unique` ON `users` (`email`);
CREATE UNIQUE INDEX `users_username_unique` ON `users` (`username`);
