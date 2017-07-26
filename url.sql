SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `url` (
  `id` int(10) NOT NULL,
  `full_url` varchar(5000) NOT NULL,
  `short_url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `url`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;