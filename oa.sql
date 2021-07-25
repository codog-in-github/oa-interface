/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : oa

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2021-07-25 18:45:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bkg
-- ----------------------------
DROP TABLE IF EXISTS `bkg`;
CREATE TABLE `bkg` (
  `id` varchar(255) NOT NULL,
  `bkg_date` datetime NOT NULL,
  `bkg_no` varchar(255) DEFAULT NULL,
  `bl_no` varchar(255) DEFAULT NULL,
  `bkg_type` varchar(255) DEFAULT NULL,
  `incoterms` varchar(255) DEFAULT NULL,
  `bkg_staff` varchar(255) DEFAULT NULL,
  `in_sales` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `month_no` int(11) DEFAULT NULL,
  `tag` char(4) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createuser` varchar(255) DEFAULT NULL,
  `delete_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of bkg
-- ----------------------------
INSERT INTO `bkg` VALUES ('16271147316211544', '2021-06-30 00:00:00', '', '', '', '', '4', '', '', null, null, '2021-07-24 18:48:26', null, '5|4@2021-07-24 18:48:26');
INSERT INTO `bkg` VALUES ('16271157161942491', '2021-07-24 08:35:16', '123', '123123', 'BOOKINGのみ　', 'CIF', '4', 'user1', 'fewfw', null, null, null, null, null);
INSERT INTO `bkg` VALUES ('16271229112416787', '2021-07-24 10:35:11', '123132', '123132', '通・ド・BK', 'C&F', '4', '4', '999', null, null, null, null, null);
INSERT INTO `bkg` VALUES ('16271806308593044', '2021-07-25 02:37:11', '008BX40954', '008BX40954', '通・ド・BK', 'C&F', '4', '', '', null, null, null, null, null);
INSERT INTO `bkg` VALUES ('16272020169937649', '2021-07-25 08:33:37', '', '', '', '', '4', '', null, null, null, null, null, null);
INSERT INTO `bkg` VALUES ('16272021958477515', '2021-07-25 08:36:36', '', '', '', '', '4', '', null, null, null, null, null, null);
INSERT INTO `bkg` VALUES ('16272022318465762', '2021-07-25 08:37:12', '', '', '', '', '4', '', null, null, null, null, null, null);
INSERT INTO `bkg` VALUES ('16272024314979778', '2021-07-25 08:40:31', '', '', '', '', '4', '', '202107', null, null, null, null, null);
INSERT INTO `bkg` VALUES ('16272024714508184', '2021-07-25 08:41:11', '1', '1', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272026628419091', '2021-07-25 08:44:23', '', '', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272026997331010', '2021-07-25 08:45:00', '', '', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272027380258003', '2021-07-25 08:45:38', '', '', '', '', '4', '', '202107', '100', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272027605523467', '2021-07-25 08:46:00', '', '', '', '', '4', '', '202107', '100', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272027637046981', '2021-07-25 08:46:04', '', '', '', '', '4', '', '202107', '100', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272027662371113', '2021-07-25 08:46:06', '', '', '', '', '4', '', '202107', '100', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272028086205420', '2021-07-25 08:46:49', '', '', '', '', '4', '', '202107', '100', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272028222603758', '2021-07-25 08:47:02', '', '', '', '', '4', '', '202107', '100', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272028758984759', '2021-07-25 08:47:56', '', '', '', '', '4', '', '202107', '100', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272029302382562', '2021-07-25 08:48:50', '', '', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272036310489386', '2021-07-25 09:01:02', '', '', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272042648433625', '2021-07-25 09:11:05', '', '', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272043119729372', '2021-07-25 09:11:52', '', '', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272044072152239', '2021-07-25 09:13:27', '', '', '', '', '4', '', '202107', null, 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272044633515150', '2021-07-25 09:14:23', '', '', '', '', '4', '', '202107', '101', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272044717432299', '2021-07-25 09:14:32', '', '', '', '', '4', '', '202107', '102', 'k', null, null, null);
INSERT INTO `bkg` VALUES ('16272087938192580', '2021-07-25 10:26:34', '', '', '', '', '', '', '202107', '105', 'k', '2021-07-25 18:33:03', null, null);

-- ----------------------------
-- Table structure for booker
-- ----------------------------
DROP TABLE IF EXISTS `booker`;
CREATE TABLE `booker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booker` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `staff` varchar(255) DEFAULT NULL,
  `staff_tel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of booker
-- ----------------------------
INSERT INTO `booker` VALUES ('1', '株式会社 東盛', '811-3124', '福岡県古賀市薬王寺910-1', '深堀様', '092-609-9708');
INSERT INTO `booker` VALUES ('2', '有限会社 中信実業通商', '839-0851', '福岡県久留米市御井町448-2', '李様', '080-5241-1454');
INSERT INTO `booker` VALUES ('3', '無錫興産 株式会社', '610-0326', '京都府京田辺市天王奥別所69番地6', '王様', '090-3359-9998');
INSERT INTO `booker` VALUES ('4', 'ジャンボフェリー 株式会社', '650-0041', '兵庫県神戸市中央区新港町3番7号', '翁様', '080-2970-9325');
INSERT INTO `booker` VALUES ('5', '株式会社 POLYTRANS', '651-0086', '兵庫県神戸市中央区磯上通8丁目1-8 アジアビルディング202', '呉様', '080-8526-3352');
INSERT INTO `booker` VALUES ('6', '新南 株式会社', '141-0021', '東京都品川区上大崎4-5-33', '佐野様', '03-5740-5331');
INSERT INTO `booker` VALUES ('7', '萬和貿易 株式会社', '537-0023', '大阪市東成区玉津1丁目5番20号', '熊様', '080-4618-2456');
INSERT INTO `booker` VALUES ('8', '有限会社 浦上化成', '671-2244', '兵庫県姫路市実法寺625番', '浦上様', '090-5969-6939');
INSERT INTO `booker` VALUES ('9', '株式会社 幸伸商事', '675-2221', '兵庫県加西市倉谷町３２４−３', '柏木様', '090-2356-3779');
INSERT INTO `booker` VALUES ('10', '明融産業 株式会社', '671-0256', '兵庫県姫路市花田町高木319', '林様', '080-3375-2430');
INSERT INTO `booker` VALUES ('11', '有限会社 橋本商会', '460-0007', '名古屋市中区新栄２丁目１番９号　雲竜ビル７階', '伊藤様', '052-242-1318');
INSERT INTO `booker` VALUES ('12', '株式会社 華盛', '490-1444', '愛知県海部郡飛島村木場２丁目8番地', '蒋様', '090-9195-9880');
INSERT INTO `booker` VALUES ('13', '林商事 株式会社', '650-0045', '神戸市中央区港島3丁目４番地', '林様', '078-381-6901');
INSERT INTO `booker` VALUES ('14', 'ギルド 株式会社', '650-0045', '神戸市中央区港島3丁目４番地', '林様', '078-381-6901');
INSERT INTO `booker` VALUES ('15', '南北 株式会社', '669-1335', '兵庫県三田市沢谷632-7', '林様', '080-3866-9888');
INSERT INTO `booker` VALUES ('16', '金峰貿易 株式会社', '800-0115', '北九州市門司区新門司3丁目67番59号', '大川様', '090-3605-0121');
INSERT INTO `booker` VALUES ('17', 'サンゴールド 株式会社', '536-0007', '大阪府大阪市城東区成育1-4-15', '知念様', '090-4293-4499');
INSERT INTO `booker` VALUES ('18', '有限会社 龍海', '657-0854', '神戸市灘区摩耶埠頭1番地Ｃ上屋２Ｆ', '百本様', '078-805-6678');
INSERT INTO `booker` VALUES ('19', '株式会社 巳翠', '596-0054', '大阪府岸和田市宮本町3-8', '西阪様', '0724-33-1400');
INSERT INTO `booker` VALUES ('20', '山田産業', '640-8392', '和歌山市中之島493-15', '山田様', '080-5356-6749');
INSERT INTO `booker` VALUES ('21', '極東海運 株式会社 門司営業所', '801-0873', '北九州市門司区東門司1丁目11番12号', '杉原様', '093-321-3933');
INSERT INTO `booker` VALUES ('22', '有限会社 不二桂商事', '290-0011', '千葉県市原市能満1878-1', '河原様', '0436-76-7072');
INSERT INTO `booker` VALUES ('23', '株式会社 イーシーオー', '814-0165', '福岡県福岡市早良区次郎丸5-5-7', '久門様', '080-5202-1744');
INSERT INTO `booker` VALUES ('24', '日本ロジステック 株式会社', '103-0027', '東京都中央区日本橋3-15-8　アミノ酸会館ビル1Ｆ', '鈴木様', '03-5202-2101');
INSERT INTO `booker` VALUES ('25', '有限会社 タカハラ', '520-0105', '滋賀県大津市下阪本3丁目20-28', '高原様', '080-3857-4049');
INSERT INTO `booker` VALUES ('26', 'サンゴールド 株式会社', '536-0007', '大阪府大阪市城東区成育1-4-15', '知念様', '');
INSERT INTO `booker` VALUES ('27', '明文産業 株式会社 ', '441-3112', '愛知県豊橋市東細谷町牛田３１−３５５', '翁様', '080-3612-9688');
INSERT INTO `booker` VALUES ('28', '永盛貿易 株式会社', '675-1358', '兵庫県小野市粟生町1506-54', '林様', '080-5632-5098');
INSERT INTO `booker` VALUES ('29', '和烽工業 株式会社', '518-0002', '三重県伊賀市千歳１６７４－1', '陳様', '');
INSERT INTO `booker` VALUES ('30', '株式会社 再資源', '598-0035', '大阪府泉佐野市南中樫井369-1', '金様', '090-8524-8632');
INSERT INTO `booker` VALUES ('31', '株式会社 日豊化学', '130-0013', '東京都墨田区錦糸2-12-1　日豊ビル', '張様', '');
INSERT INTO `booker` VALUES ('32', 'Cross Industry 株式会社', '556-0012', '大阪府大阪市浪速区敷津東3丁目１１－６　松尾ビル　303号', '張様', '080-6695-7419');
INSERT INTO `booker` VALUES ('33', '明耀興産 合同会社', '652-0036', '神戸市兵庫区福原町14-2 常本ビル302', '翁様', '');
INSERT INTO `booker` VALUES ('34', 'AE通商 株式会社', '560-0085', '大阪府豊中市上新田四丁目16-5-401', '馮様', '');
INSERT INTO `booker` VALUES ('35', '高享化学 株式会社', '936-0841', '富山県滑川市柴170-1', '陳様', '090-1326-6768');
INSERT INTO `booker` VALUES ('36', '株式会社 大都商会', '170-0004', '東京都豊島区北大塚3-34-1　第一大都ビル', '劉様', '090-2456-3681');

-- ----------------------------
-- Table structure for container
-- ----------------------------
DROP TABLE IF EXISTS `container`;
CREATE TABLE `container` (
  `id` varchar(255) NOT NULL,
  `common` varchar(255) DEFAULT NULL,
  `van_place` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of container
-- ----------------------------
INSERT INTO `container` VALUES ('16266599169334553', '', null, '', null);
INSERT INTO `container` VALUES ('16266649767842942', '', null, '', null);
INSERT INTO `container` VALUES ('16267506815131277', '', null, '', null);
INSERT INTO `container` VALUES ('16267513267359986', 'PLASTIC', '|', '', null);
INSERT INTO `container` VALUES ('16270138748907216', '233', '', '', null);
INSERT INTO `container` VALUES ('16270141222352616', '', null, '', null);
INSERT INTO `container` VALUES ('16270141750182028', '', null, '', null);
INSERT INTO `container` VALUES ('16270376832708096', 'PLASTIC', '1|2|55', '', null);
INSERT INTO `container` VALUES ('16270534307637831', '111', null, '', null);
INSERT INTO `container` VALUES ('16270535283206496', '12', null, '', null);
INSERT INTO `container` VALUES ('16271126066812858', 'PLASTIC', '', 'qwqdw', null);
INSERT INTO `container` VALUES ('16271128755658726', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271138504157557', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271142363214281', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271142434539064', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271142567128958', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271142641706355', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271142678215921', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271142779767467', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271142881567999', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271147026297973', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271147092256618', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271147148384284', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271147316211544', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271147363943417', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16271157161942491', 'PLASTIC', '21|313', '1231', null);
INSERT INTO `container` VALUES ('16271229112416787', 'PLASTIC', '1231231', 'BEIZHU', null);
INSERT INTO `container` VALUES ('16271806308593044', 'PLASTIC', '大阪府泉佐野市南中樫井369-1', '', null);
INSERT INTO `container` VALUES ('16272020169937649', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272021958477515', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272022318465762', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272024314979778', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272024714508184', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272026628419091', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272026997331010', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272027380258003', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272027605523467', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272027637046981', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272027662371113', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272028086205420', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272028222603758', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272028758984759', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272029302382562', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272036310489386', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272042648433625', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272043119729372', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272044072152239', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272044633515150', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272044717432299', 'PLASTIC', '', '', null);
INSERT INTO `container` VALUES ('16272087938192580', 'PLASTIC', '', '', 'D|B|S');

-- ----------------------------
-- Table structure for container_detail
-- ----------------------------
DROP TABLE IF EXISTS `container_detail`;
CREATE TABLE `container_detail` (
  `id` varchar(255) NOT NULL,
  `bkg_id` varchar(255) NOT NULL,
  `container_id` varchar(255) NOT NULL,
  `container_type` varchar(255) DEFAULT NULL,
  `common` varchar(255) DEFAULT NULL,
  `option` varchar(255) DEFAULT NULL,
  `expenses` varchar(255) DEFAULT NULL,
  `transprotation` varchar(255) DEFAULT NULL,
  `charge` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `chassis` varchar(255) DEFAULT NULL,
  `booker_place` varchar(255) DEFAULT NULL,
  `vanning_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `vanning_during` varchar(255) DEFAULT NULL,
  `delete_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of container_detail
-- ----------------------------
INSERT INTO `container_detail` VALUES ('16266649768382616', '16266649767842942', '16266649768258434', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16266650680673881', '16266649767842942', '16266650644673550', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16266650721078917', '16266649767842942', '16266650644673550', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16266695910301606', '16266599169334553', '16266687551765404', '20RF', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16266695926305171', '16266599169334553', '16266695853502107', '20FR', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16267506815927238', '16267506815131277', '16267506815744078', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16270138749534921', '16270138748907216', '16270138749352584', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16270141223019043', '16270141222352616', '16270141222794360', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16270141750717178', '16270141750182028', '16270141750561545', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16270376833506289', '16270376832708096', '16270376833219330', '', '', '', '2021-07-24T04:03:54.000Z', '', '', '', '', '', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16270387183543798', '16270376832708096', '16270376833219330', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '12:48 - 13:47', '1');
INSERT INTO `container_detail` VALUES ('16270411875462053', '16270376832708096', '16270376833219330', '40RF', '', '', '', '', '', '', '', '', '1899-11-08 00:00:00', '12:48-23:46', '1');
INSERT INTO `container_detail` VALUES ('16270411908275941', '16270376832708096', '16270387239452188', '40RF', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16270534308524675', '16270534307637831', '16270534308274803', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16270535284153321', '16270535283206496', '16270535283931529', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', null);
INSERT INTO `container_detail` VALUES ('16271062665626433', '16270138748907216', '16270138749352584', '', '233', '', 'P', '2', '', '', '', '', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271062689063547', '16270138748907216', '16270138749352584', '', '233', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271126067348191', '16271126066812858', '16271126067126100', '40OP', 'qweqwqe', 'qqwe', 'wqewqe', 'qweqwe', 'wqeqwe', 'qweqwe', 'qwe', '', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271127297214471', '16271126066812858', '16271126067126100', '40RF', '', '', '', '無錫興産 株式会社', '610-0326', '王様', '', '京都府京田辺市天王奥別所69番地6', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271127354245804', '16271126066812858', '16271126067126100', '40RF', '', '', '', '無錫興産 株式会社', '610-0326', '王様', '', '京都府京田辺市天王奥別所69番地6', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271127432392379', '16271126066812858', '16271126067126100', '40OP', 'qweqwqe', 'qqwe', 'wqewqe', 'qweqwe', 'wqeqwe', 'qweqwe', 'qwe', '', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271128756173165', '16271128755658726', '16271128755973256', '', '', '', '', '萬和貿易 株式会社', '537-0023', '熊様', '', '大阪市東成区玉津1丁目5番20号', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271129355426846', '16271128755658726', '16271128755973256', '', '', '', '', 'サンゴールド 株式会社', '536-0007', '知念様', '', '大阪府大阪市城東区成育1-4-15', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271129607472501', '16271128755658726', '16271128755973256', '', '', '', '', 'サンゴールド 株式会社', '536-0007', '知念様', '', '大阪府大阪市城東区成育1-4-15', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271138505129419', '16271138504157557', '16271138504881929', '', '233', '', '', '萬和貿易 株式会社', '537-0023', '熊様', '', '大阪市東成区玉津1丁目5番20号', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271139002335383', '16271138504157557', '16271138984834641', '', '233', '', '', '萬和貿易 株式会社', '537-0023', '熊様', '', '大阪市東成区玉津1丁目5番20号', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271142363725963', '16271142363214281', '16271142363513908', '', '233', '', '', '有限会社 中信実業通商', '839-0851', '李様', '', '福岡県久留米市御井町448-2', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271142435271706', '16271142434539064', '16271142435061892', '', '233', '', '', '有限会社 中信実業通商', '839-0851', '李様', '', '福岡県久留米市御井町448-2', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271142567908154', '16271142567128958', '16271142567593692', '', '233', '', '', '有限会社 中信実業通商', '839-0851', '李様', '', '福岡県久留米市御井町448-2', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271142642262597', '16271142641706355', '16271142642022146', '', '233', '', '', '有限会社 中信実業通商', '839-0851', '李様', '', '福岡県久留米市御井町448-2', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271142678727304', '16271142678215921', '16271142678549921', '', '233', '', '', '有限会社 中信実業通商', '839-0851', '李様', '', '福岡県久留米市御井町448-2', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271142780352245', '16271142779767467', '16271142780159814', '', '233', '', '', '有限会社 中信実業通商', '839-0851', '李様', '', '福岡県久留米市御井町448-2', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271142882337079', '16271142881567999', '16271142882017365', '', '233', '', '', '有限会社 中信実業通商', '839-0851', '李様', '', '福岡県久留米市御井町448-2', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271146518801996', '16267513267359986', '16271126601226563', '', '', '', '', '萬和貿易 株式会社', '537-0023', '熊様', '', '大阪市東成区玉津1丁目5番20号', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271147026773328', '16271147026297973', '16271147026651084', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271147092555005', '16271147092256618', '16271147092456342', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271147148706842', '16271147148384284', '16271147148616245', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271147317086225', '16271147316211544', '16271147316871085', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271147364214715', '16271147363943417', '16271147364136303', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271157162464939', '16271157161942491', '16271157162265444', '40RF', '431', '311', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16271157974117472', '16271157161942491', '16271157162265444', '40RF', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271229112874532', '16271229112416787', '16271229112764876', '20OP', '33', '33', '33', '株式会社 東盛', '811-3124', '深堀様', '22', '福岡県古賀市薬王寺910-1', '2021-06-28 00:00:00', '18:34-19:36', '');
INSERT INTO `container_detail` VALUES ('16271229844126320', '16271229112416787', '16271229112764876', '20OP', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271229874255472', '16271229112416787', '16271229112764876', '20OP', '33', '33', '33', '株式会社 東盛', '811-3124', '深堀様', '22', '福岡県古賀市薬王寺910-1', '2021-06-28 00:00:00', '18:34-19:36', '');
INSERT INTO `container_detail` VALUES ('16271229965366088', '16271229112416787', '16271229933208407', '20FR', 'FWQD', '12', '12', '株式会社 東盛', '811-3124', '深堀様', '21', '福岡県古賀市薬王寺910-1', '2021-06-29 00:00:00', '18:36-19:36', '');
INSERT INTO `container_detail` VALUES ('16271230055575774', '16271229112416787', '16271229933208407', '20FR', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '1');
INSERT INTO `container_detail` VALUES ('16271230071385264', '16271229112416787', '16271229933208407', '20FR', 'FWQD', '12', '12', '株式会社 東盛', '811-3124', '深堀様', '21', '福岡県古賀市薬王寺910-1', '2021-06-29 00:00:00', '18:36-19:36', '');
INSERT INTO `container_detail` VALUES ('16271806311283120', '16271806308593044', '16271806310759885', '40FR', '1', '', 'あり', '株式会社 再資源', '598-0035', '金様', '', '大阪府泉佐野市南中樫井369-1', '2021-07-14 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272020171221757', '16272020169937649', '16272020170915164', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272021959535814', '16272021958477515', '16272021959279117', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272022319511284', '16272022318465762', '16272022319238149', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272024316347267', '16272024314979778', '16272024315904154', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272024715765512', '16272024714508184', '16272024715428195', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272026629503379', '16272026628419091', '16272026629196367', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272026998448928', '16272026997331010', '16272026998101793', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272027381368659', '16272027380258003', '16272027381089769', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272027606598798', '16272027605523467', '16272027606289328', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272027638044858', '16272027637046981', '16272027637794369', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272027663493611', '16272027662371113', '16272027663244176', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272028087361683', '16272028086205420', '16272028086966180', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272028223692414', '16272028222603758', '16272028223424094', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272028760114920', '16272028758984759', '16272028759839813', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272029303561866', '16272029302382562', '16272029303296842', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272036311478741', '16272036310489386', '16272036311218829', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272042651252196', '16272042648433625', '16272042650626742', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272043120889422', '16272043119729372', '16272043120627924', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272044073329140', '16272044072152239', '16272044073063837', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272044634898749', '16272044633515150', '16272044634621550', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272044718725080', '16272044717432299', '16272044718309481', '', '', '', '', null, null, null, '', null, '0000-00-00 00:00:00', '', '');
INSERT INTO `container_detail` VALUES ('16272087940287596', '16272087938192580', '16272087939751270', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '');

-- ----------------------------
-- Table structure for container_type
-- ----------------------------
DROP TABLE IF EXISTS `container_type`;
CREATE TABLE `container_type` (
  `id` varchar(255) NOT NULL,
  `bkg_id` varchar(255) NOT NULL,
  `container_type` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of container_type
-- ----------------------------
INSERT INTO `container_type` VALUES ('16266649768258434', '16266649767842942', '', '1', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16266650644673550', '16266649767842942', '', '2', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16266687551765404', '16266599169334553', '20RF', '11', '2021-07-19 12:39:58');
INSERT INTO `container_type` VALUES ('16266695853502107', '16266599169334553', '20FR', '11', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16267506815744078', '16267506815131277', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16270138749352584', '16270138748907216', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16270141222794360', '16270141222352616', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16270141750561545', '16270141750182028', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16270376833219330', '16270376832708096', '40RF', '234', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16270387239452188', '16270376832708096', '40RF', '2', '2021-07-23 19:53:17');
INSERT INTO `container_type` VALUES ('16270534308274803', '16270534307637831', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16270535283931529', '16270535283206496', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271126067126100', '16271126066812858', '40RF', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271126601226563', '16267513267359986', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271128755973256', '16271128755658726', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271138504881929', '16271138504157557', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271138984834641', '16271138504157557', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271142363513908', '16271142363214281', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271142435061892', '16271142434539064', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271142567593692', '16271142567128958', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271142642022146', '16271142641706355', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271142678549921', '16271142678215921', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271142780159814', '16271142779767467', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271142882017365', '16271142881567999', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271147026651084', '16271147026297973', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271147092456342', '16271147092256618', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271147148616245', '16271147148384284', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271147316871085', '16271147316211544', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271147364136303', '16271147363943417', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271157162265444', '16271157161942491', '20RF', '1', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271229112764876', '16271229112416787', '20OP', '333', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271229933208407', '16271229112416787', '20FR', '12312', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16271806310759885', '16271806308593044', '40FR', '1', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272020170915164', '16272020169937649', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272021959279117', '16272021958477515', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272022319238149', '16272022318465762', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272024315904154', '16272024314979778', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272024715428195', '16272024714508184', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272026629196367', '16272026628419091', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272026998101793', '16272026997331010', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272027381089769', '16272027380258003', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272027606289328', '16272027605523467', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272027637794369', '16272027637046981', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272027663244176', '16272027662371113', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272028086966180', '16272028086205420', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272028223424094', '16272028222603758', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272028759839813', '16272028758984759', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272029303296842', '16272029302382562', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272036311218829', '16272036310489386', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272042650626742', '16272042648433625', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272043120627924', '16272043119729372', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272044073063837', '16272044072152239', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272044634621550', '16272044633515150', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272044718309481', '16272044717432299', '', '', '0000-00-00 00:00:00');
INSERT INTO `container_type` VALUES ('16272087939751270', '16272087938192580', '', '', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', '0', 'Bahrain', 'BH');
INSERT INTO `country` VALUES ('2', '1', 'Khalifa Bin Salman Port', 'KSP');
INSERT INTO `country` VALUES ('3', '0', 'Bangladesh', 'BD');
INSERT INTO `country` VALUES ('4', '3', 'Chattogram', 'CGP');
INSERT INTO `country` VALUES ('5', '3', 'Dhaka', 'DAC');
INSERT INTO `country` VALUES ('6', '0', 'Cambodia', 'KH');
INSERT INTO `country` VALUES ('7', '6', 'Phnom Penh', 'PNH');
INSERT INTO `country` VALUES ('8', '6', 'Sihanoukville', 'SIH');
INSERT INTO `country` VALUES ('9', '0', 'China', 'CN');
INSERT INTO `country` VALUES ('10', '9', 'Anji', 'ANJ');
INSERT INTO `country` VALUES ('11', '9', 'Anqing', 'AQG');
INSERT INTO `country` VALUES ('12', '9', 'Baoan', 'BAO');
INSERT INTO `country` VALUES ('13', '9', 'Beijing', 'BJS');
INSERT INTO `country` VALUES ('14', '9', 'Bengbu', 'BBU');
INSERT INTO `country` VALUES ('15', '9', 'Changde', 'CGD');
INSERT INTO `country` VALUES ('16', '9', 'Changsha', 'CSX');
INSERT INTO `country` VALUES ('17', '9', 'Changshu', 'CGS');
INSERT INTO `country` VALUES ('18', '9', 'Changzhou', 'CZX');
INSERT INTO `country` VALUES ('19', '9', 'Chizhou', 'CZH');
INSERT INTO `country` VALUES ('20', '9', 'Dachanbay', 'DCB');
INSERT INTO `country` VALUES ('21', '9', 'Dalian', 'DLC');
INSERT INTO `country` VALUES ('22', '9', 'Damaiyu', 'DMY');
INSERT INTO `country` VALUES ('23', '9', 'Danshui', 'DSH');
INSERT INTO `country` VALUES ('24', '9', 'Deqing', 'DEQ');
INSERT INTO `country` VALUES ('25', '9', 'Dongguan', 'DGG');
INSERT INTO `country` VALUES ('26', '9', 'Futian', 'FTN');
INSERT INTO `country` VALUES ('27', '9', 'Fuyong', 'FFY');
INSERT INTO `country` VALUES ('28', '9', 'Gaosha', 'GSH');
INSERT INTO `country` VALUES ('29', '9', 'Guang Zhou', 'CAN');
INSERT INTO `country` VALUES ('30', '9', 'Haimen', 'HME');
INSERT INTO `country` VALUES ('31', '9', 'Hangzhou', 'HGH');
INSERT INTO `country` VALUES ('32', '9', 'Harbin', 'HRB');
INSERT INTO `country` VALUES ('33', '9', 'Huangshi', 'HSI');
INSERT INTO `country` VALUES ('34', '9', 'Huidong', 'HIG');
INSERT INTO `country` VALUES ('35', '9', 'Huiyang', 'HYN');
INSERT INTO `country` VALUES ('36', '9', 'Huzhou', 'HZH');
INSERT INTO `country` VALUES ('37', '9', 'Jiaxing', 'JXN');
INSERT INTO `country` VALUES ('38', '9', 'Jinan', 'JNN');
INSERT INTO `country` VALUES ('39', '9', 'Jingzhou', 'JIN');
INSERT INTO `country` VALUES ('40', '9', 'Kaiping', 'KPG');
INSERT INTO `country` VALUES ('41', '9', 'Kemen', 'KMN');
INSERT INTO `country` VALUES ('42', '9', 'Kunshan', 'KUS');
INSERT INTO `country` VALUES ('43', '9', 'Lianyungang', 'LYG');
INSERT INTO `country` VALUES ('44', '9', 'Liuzhou', 'LZH');
INSERT INTO `country` VALUES ('45', '9', 'Longgang', 'LGG');
INSERT INTO `country` VALUES ('46', '9', 'Longkou', 'LKU');
INSERT INTO `country` VALUES ('47', '9', 'Luzhou', 'LUZ');
INSERT INTO `country` VALUES ('48', '9', 'Macau', 'MAC');
INSERT INTO `country` VALUES ('49', '9', 'Mayong', 'MYG');
INSERT INTO `country` VALUES ('50', '9', 'Nanchang', 'NCH');
INSERT INTO `country` VALUES ('51', '9', 'Nanjing', 'NKG');
INSERT INTO `country` VALUES ('52', '9', 'Nanning', 'NNN');
INSERT INTO `country` VALUES ('53', '9', 'Nansha New Port', 'NNS');
INSERT INTO `country` VALUES ('54', '9', 'Nantong', 'NTG');
INSERT INTO `country` VALUES ('55', '9', 'Nantou', 'NTU');
INSERT INTO `country` VALUES ('56', '9', 'Ningbo', 'NBO');
INSERT INTO `country` VALUES ('57', '9', 'Putian', 'PUT');
INSERT INTO `country` VALUES ('58', '9', 'Qingdao', 'TAO');
INSERT INTO `country` VALUES ('59', '9', 'Qingyuan', 'QYN');
INSERT INTO `country` VALUES ('60', '9', 'Qinhuangdao', 'SHP');
INSERT INTO `country` VALUES ('61', '9', 'Shanghai', 'SHA');
INSERT INTO `country` VALUES ('62', '9', 'Shekou', 'SHK');
INSERT INTO `country` VALUES ('63', '9', 'Shenyang', 'SHE');
INSERT INTO `country` VALUES ('64', '9', 'Shenzhen', 'SZP');
INSERT INTO `country` VALUES ('65', '9', 'Shidao', 'SDA');
INSERT INTO `country` VALUES ('66', '9', 'Shilong', 'SIL');
INSERT INTO `country` VALUES ('67', '9', 'Suzhou', 'SZH');
INSERT INTO `country` VALUES ('68', '9', 'Taicang', 'TCG');
INSERT INTO `country` VALUES ('69', '9', 'Taizhou', 'TAZ');
INSERT INTO `country` VALUES ('70', '9', 'Tanggu', 'TGU');
INSERT INTO `country` VALUES ('71', '9', 'Tianjin', 'TSN');
INSERT INTO `country` VALUES ('72', '9', 'Tongling', 'TOL');
INSERT INTO `country` VALUES ('73', '9', 'Weihai', 'WEI');
INSERT INTO `country` VALUES ('74', '9', 'Wenzhou', 'WNZ');
INSERT INTO `country` VALUES ('75', '9', 'Wu Chong Kou', 'WUC');
INSERT INTO `country` VALUES ('76', '9', 'Wuhan', 'WUH');
INSERT INTO `country` VALUES ('77', '9', 'Wuhu', 'WHI');
INSERT INTO `country` VALUES ('78', '9', 'Wujiang', 'WJG');
INSERT INTO `country` VALUES ('79', '9', 'Wuxi', 'WUX');
INSERT INTO `country` VALUES ('80', '9', 'Xi An', 'SIA');
INSERT INTO `country` VALUES ('81', '9', 'Xiamen', 'XMN');
INSERT INTO `country` VALUES ('82', '9', 'Xingang', 'XGG');
INSERT INTO `country` VALUES ('83', '9', 'Yangzhou', 'YZH');
INSERT INTO `country` VALUES ('84', '9', 'Yantai', 'YAN');
INSERT INTO `country` VALUES ('85', '9', 'Yantian', 'YTN');
INSERT INTO `country` VALUES ('86', '9', 'Yibin', 'YIB');
INSERT INTO `country` VALUES ('87', '9', 'Yichang', 'YCH');
INSERT INTO `country` VALUES ('88', '9', 'Yingkou', 'YIK');
INSERT INTO `country` VALUES ('89', '9', 'Yueyang', 'YYA');
INSERT INTO `country` VALUES ('90', '9', 'Zhangjiagang', 'ZJG');
INSERT INTO `country` VALUES ('91', '9', 'Zhangzhou', 'ZZU');
INSERT INTO `country` VALUES ('92', '9', 'Zhapu', 'ZAP');
INSERT INTO `country` VALUES ('93', '9', 'Zhenjiang', 'ZHE');
INSERT INTO `country` VALUES ('94', '9', 'Zhongshan', 'ZSN');
INSERT INTO `country` VALUES ('95', '9', 'Zhoushan', 'ZOS');
INSERT INTO `country` VALUES ('96', '9', 'Zhuhai', 'ZHH');
INSERT INTO `country` VALUES ('97', '9', 'Zibo', 'ZIB');
INSERT INTO `country` VALUES ('98', '0', 'Hong Kong', 'HK');
INSERT INTO `country` VALUES ('99', '98', 'Hong Kong', 'HKG');
INSERT INTO `country` VALUES ('100', '0', 'India', 'IN');
INSERT INTO `country` VALUES ('101', '100', 'Aequs Sez Belgaum', 'BGQ');
INSERT INTO `country` VALUES ('102', '100', 'Apache Sez', 'APA');
INSERT INTO `country` VALUES ('103', '100', 'Arshiya Ftwz Khurja', 'AFK');
INSERT INTO `country` VALUES ('104', '100', 'Cangaikondan Sez Sipcot', 'COT');
INSERT INTO `country` VALUES ('105', '100', 'Chennai', 'MAA');
INSERT INTO `country` VALUES ('106', '100', 'Cheyyar Sez Pochampalli', 'POC');
INSERT INTO `country` VALUES ('107', '100', 'Cochin', 'COK');
INSERT INTO `country` VALUES ('108', '100', 'Ftil Sez', 'FTI');
INSERT INTO `country` VALUES ('109', '100', 'Gigaplex Estate Pvt Ltd Sez Airoli', 'GPE');
INSERT INTO `country` VALUES ('110', '100', 'Haldia', 'HAL');
INSERT INTO `country` VALUES ('111', '100', 'Hazira', 'HZR');
INSERT INTO `country` VALUES ('112', '100', 'Icd  Tondiarpet', 'TDT');
INSERT INTO `country` VALUES ('113', '100', 'Icd Actl', 'ATL');
INSERT INTO `country` VALUES ('114', '100', 'Icd Agra', 'AGR');
INSERT INTO `country` VALUES ('115', '100', 'Icd Ahmedabad', 'AMD');
INSERT INTO `country` VALUES ('116', '100', 'Icd Ankleshwar', 'ANK');
INSERT INTO `country` VALUES ('117', '100', 'Icd Arrakonam', 'AKM');
INSERT INTO `country` VALUES ('118', '100', 'Icd Bangalore', 'BLR');
INSERT INTO `country` VALUES ('119', '100', 'Icd Bawal', 'BWL');
INSERT INTO `country` VALUES ('120', '100', 'Icd Chakan Pune', 'CKP');
INSERT INTO `country` VALUES ('121', '100', 'Icd Dadri', 'DRI');
INSERT INTO `country` VALUES ('122', '100', 'Icd Dhannad', 'DNN');
INSERT INTO `country` VALUES ('123', '100', 'Icd Dighi', 'DIG');
INSERT INTO `country` VALUES ('124', '100', 'Icd Gharhi Harsaru', 'GHR');
INSERT INTO `country` VALUES ('125', '100', 'Icd Hyderabad', 'HDB');
INSERT INTO `country` VALUES ('126', '100', 'Icd Irunkattukottai', 'ITT');
INSERT INTO `country` VALUES ('127', '100', 'Icd Jodhpur', 'JDR');
INSERT INTO `country` VALUES ('128', '100', 'Icd Kanpur', 'KPR');
INSERT INTO `country` VALUES ('129', '100', 'Icd Kashipur', 'KSH');
INSERT INTO `country` VALUES ('130', '100', 'Icd Kilaraipur', 'QRP');
INSERT INTO `country` VALUES ('131', '100', 'Icd Kota', 'KOT');
INSERT INTO `country` VALUES ('132', '100', 'Icd Loni', 'LON');
INSERT INTO `country` VALUES ('133', '100', 'Icd Ludhiana', 'LDH');
INSERT INTO `country` VALUES ('134', '100', 'Icd Malanpur', 'MPR');
INSERT INTO `country` VALUES ('135', '100', 'Icd Mandideep', 'MDD');
INSERT INTO `country` VALUES ('136', '100', 'Icd Moradabad', 'MOB');
INSERT INTO `country` VALUES ('137', '100', 'Icd Mulund', 'MUU');
INSERT INTO `country` VALUES ('138', '100', 'Icd Nagpur', 'NGA');
INSERT INTO `country` VALUES ('139', '100', 'Icd Palwal', 'PWL');
INSERT INTO `country` VALUES ('140', '100', 'Icd Patpargang', 'PGA');
INSERT INTO `country` VALUES ('141', '100', 'Icd Patparganj', 'PPG');
INSERT INTO `country` VALUES ('142', '100', 'Icd Piyala', 'PYL');
INSERT INTO `country` VALUES ('143', '100', 'Icd Rajnandgaon Sez', 'RAJ');
INSERT INTO `country` VALUES ('144', '100', 'Icd Rori Kril Modinagar', 'ROR');
INSERT INTO `country` VALUES ('145', '100', 'Icd Sachana', 'JKA');
INSERT INTO `country` VALUES ('146', '100', 'Icd Sachin', 'SAC');
INSERT INTO `country` VALUES ('147', '100', 'Icd Sanand', 'SAU');
INSERT INTO `country` VALUES ('148', '100', 'Icd Sattva Pondicherry', 'SVP');
INSERT INTO `country` VALUES ('149', '100', 'Icd Sonipat', 'BDM');
INSERT INTO `country` VALUES ('150', '100', 'Icd Talegaon', 'TLG');
INSERT INTO `country` VALUES ('151', '100', 'Icd Tarapur', 'TRP');
INSERT INTO `country` VALUES ('152', '100', 'Icd Thar Jodhpur', 'THJ');
INSERT INTO `country` VALUES ('153', '100', 'Icd Tihi', 'THI');
INSERT INTO `country` VALUES ('154', '100', 'Icd Tughlakabad', 'TKD');
INSERT INTO `country` VALUES ('155', '100', 'Icd Valvada Gujarat', 'VVD');
INSERT INTO `country` VALUES ('156', '100', 'Icd Waluj ', 'IWL');
INSERT INTO `country` VALUES ('157', '100', 'Jaipur Sez', 'JSZ');
INSERT INTO `country` VALUES ('158', '100', 'Jamnagar Sez', 'JGA');
INSERT INTO `country` VALUES ('159', '100', 'Jhattipur', 'JHT');
INSERT INTO `country` VALUES ('160', '100', 'Kandla Sez', 'KLS');
INSERT INTO `country` VALUES ('161', '100', 'Kandla', 'IXY');
INSERT INTO `country` VALUES ('162', '100', 'Kattupalli', 'KTP');
INSERT INTO `country` VALUES ('163', '100', 'Kolkata', 'CCU');
INSERT INTO `country` VALUES ('164', '100', 'Mumbai', 'BOM');
INSERT INTO `country` VALUES ('165', '100', 'Mundra', 'MUN');
INSERT INTO `country` VALUES ('166', '100', 'Naidupet Sez', 'NAI');
INSERT INTO `country` VALUES ('167', '100', 'Ndr Sez', 'NDR');
INSERT INTO `country` VALUES ('168', '100', 'New Delhi Cy', 'ICD');
INSERT INTO `country` VALUES ('169', '100', 'Nhava Sheva', 'NSA');
INSERT INTO `country` VALUES ('170', '100', 'Nipl Sez Sriperumbudur', 'NIP');
INSERT INTO `country` VALUES ('171', '100', 'Patli', 'PTI');
INSERT INTO `country` VALUES ('172', '100', 'Seepz Sez', 'SPZ');
INSERT INTO `country` VALUES ('173', '100', 'Sez  Pune Embassy Project Pvt Ltd', 'PEP');
INSERT INTO `country` VALUES ('174', '100', 'Sez  Shendra', 'AWW');
INSERT INTO `country` VALUES ('175', '100', 'Sez Aurum Platz It Pvt Ltd', 'API');
INSERT INTO `country` VALUES ('176', '100', 'Sez Biacpl ', 'BCL');
INSERT INTO `country` VALUES ('177', '100', 'Sez Biocon Blr', 'BIO');
INSERT INTO `country` VALUES ('178', '100', 'Sez Chengalpattu', 'CHN');
INSERT INTO `country` VALUES ('179', '100', 'Sez Eon Kharadi Infrastructure Pvt Ltd', 'EKI');
INSERT INTO `country` VALUES ('180', '100', 'Sez Hubali', 'HBL');
INSERT INTO `country` VALUES ('181', '100', 'Sez Jnpt', 'JNP');
INSERT INTO `country` VALUES ('182', '100', 'Sez Kesurdi', 'KSU');
INSERT INTO `country` VALUES ('183', '100', 'Sez Mahaboobnagar', 'MHB');
INSERT INTO `country` VALUES ('184', '100', 'Sez Mahindra World City Jaipur ', 'MWC');
INSERT INTO `country` VALUES ('185', '100', 'Sez Mohali', 'MHL');
INSERT INTO `country` VALUES ('186', '100', 'Sez Noida', 'NOI');
INSERT INTO `country` VALUES ('187', '100', 'Sez Phaltan', 'PLT');
INSERT INTO `country` VALUES ('188', '100', 'Sez Qubix Business Park Pvt Ltd', 'QBP');
INSERT INTO `country` VALUES ('189', '100', 'Sez Satara', 'STR');
INSERT INTO `country` VALUES ('190', '100', 'Sez Surat Apparel Park', 'SAP');
INSERT INTO `country` VALUES ('191', '100', 'Sez Tarapur', 'TPU');
INSERT INTO `country` VALUES ('192', '100', 'Sez Tarapur', 'TRU');
INSERT INTO `country` VALUES ('193', '100', 'Sez Thiruvananthapuram', 'THU');
INSERT INTO `country` VALUES ('194', '100', 'Sez Visakhapatnam', 'VIS');
INSERT INTO `country` VALUES ('195', '100', 'Sez Vizag Rpcipl', 'VIZ');
INSERT INTO `country` VALUES ('196', '100', 'Sez Zydus Infrastructure Pvt Ltd', 'ZIP');
INSERT INTO `country` VALUES ('197', '100', 'Sipcot Gangaikondan Sez', 'GAN');
INSERT INTO `country` VALUES ('198', '100', 'Sipcot Hitech Sez', 'SPI');
INSERT INTO `country` VALUES ('199', '100', 'Sipcot Sez Erode', 'SIP');
INSERT INTO `country` VALUES ('200', '100', 'Tambaram Sez', 'TMM');
INSERT INTO `country` VALUES ('201', '100', 'Tihi Indorea', 'TIH');
INSERT INTO `country` VALUES ('202', '100', 'Tuticorin', 'TUT');
INSERT INTO `country` VALUES ('203', '100', 'Visakhapatnam Sez', 'VSA');
INSERT INTO `country` VALUES ('204', '100', 'Wipro Sarjapur Sez', 'WIP');
INSERT INTO `country` VALUES ('205', '0', 'Indonesia', 'ID');
INSERT INTO `country` VALUES ('206', '205', 'Balikpapan', 'BAN');
INSERT INTO `country` VALUES ('207', '205', 'Bandung', 'BDG');
INSERT INTO `country` VALUES ('208', '205', 'Bandung', 'BDO');
INSERT INTO `country` VALUES ('209', '205', 'Banjarmasin', 'BDJ');
INSERT INTO `country` VALUES ('210', '205', 'Batam', 'BTM');
INSERT INTO `country` VALUES ('211', '205', 'Belawan', 'BLW');
INSERT INTO `country` VALUES ('212', '205', 'Bengkulu', 'BKS');
INSERT INTO `country` VALUES ('213', '205', 'Bitung', 'BIT');
INSERT INTO `country` VALUES ('214', '205', 'Cikarang Dry Port', 'CDP');
INSERT INTO `country` VALUES ('215', '205', 'Dumai', 'DUM');
INSERT INTO `country` VALUES ('216', '205', 'Jakarta', 'JKT');
INSERT INTO `country` VALUES ('217', '205', 'Jambi', 'DJB');
INSERT INTO `country` VALUES ('218', '205', 'Makassar', 'MKR');
INSERT INTO `country` VALUES ('219', '205', 'Padang', 'PDG');
INSERT INTO `country` VALUES ('220', '205', 'Palembang', 'PLM');
INSERT INTO `country` VALUES ('221', '205', 'Pangkal Balam', 'PGX');
INSERT INTO `country` VALUES ('222', '205', 'Panjang', 'PJG');
INSERT INTO `country` VALUES ('223', '205', 'Pekanbaru', 'PKU');
INSERT INTO `country` VALUES ('224', '205', 'Perawang', 'PWG');
INSERT INTO `country` VALUES ('225', '205', 'Pontianak', 'PNK');
INSERT INTO `country` VALUES ('226', '205', 'Samarinda', 'SRI');
INSERT INTO `country` VALUES ('227', '205', 'Sampit', 'SMQ');
INSERT INTO `country` VALUES ('228', '205', 'Semarang', 'SRG');
INSERT INTO `country` VALUES ('229', '205', 'Surabaya', 'SUB');
INSERT INTO `country` VALUES ('230', '205', 'Ujung Pandang', 'UPG');
INSERT INTO `country` VALUES ('231', '0', 'Iran', 'IR');
INSERT INTO `country` VALUES ('232', '231', 'Bandar Imam Khomeini', 'BIK');
INSERT INTO `country` VALUES ('233', '231', 'Khorramshahr', 'KHO');
INSERT INTO `country` VALUES ('234', '0', 'Iraq', 'IQ');
INSERT INTO `country` VALUES ('235', '234', 'Umm Qasr', 'UQR');
INSERT INTO `country` VALUES ('236', '0', 'Japan', 'JP');
INSERT INTO `country` VALUES ('237', '236', 'Akita', 'AXT');
INSERT INTO `country` VALUES ('238', '236', 'Chiba', 'CHB');
INSERT INTO `country` VALUES ('239', '236', 'Fukuyama', 'FKY');
INSERT INTO `country` VALUES ('240', '236', 'Hachinohe', 'HHE');
INSERT INTO `country` VALUES ('241', '236', 'Hakata', 'HKT');
INSERT INTO `country` VALUES ('242', '236', 'Hakodate', 'HKD');
INSERT INTO `country` VALUES ('243', '236', 'Hibikinada', 'HBK');
INSERT INTO `country` VALUES ('244', '236', 'Himeji', 'HIM');
INSERT INTO `country` VALUES ('245', '236', 'Hiroshima', 'HIJ');
INSERT INTO `country` VALUES ('246', '236', 'Hitachinaka', 'HTA');
INSERT INTO `country` VALUES ('247', '236', 'Hososhima', 'HSM');
INSERT INTO `country` VALUES ('248', '236', 'Imabari', 'IMB');
INSERT INTO `country` VALUES ('249', '236', 'Imari', 'IMI');
INSERT INTO `country` VALUES ('250', '236', 'Ishikari', 'ISI');
INSERT INTO `country` VALUES ('251', '236', 'Iwakuni', 'IWK');
INSERT INTO `country` VALUES ('252', '236', 'Iyomishima', 'IYM');
INSERT INTO `country` VALUES ('253', '236', 'Kagoshima', 'KOJ');
INSERT INTO `country` VALUES ('254', '236', 'Kamaishi', 'KIS');
INSERT INTO `country` VALUES ('255', '236', 'Kanazawa', 'KNZ');
INSERT INTO `country` VALUES ('256', '236', 'Kashima', 'KSM');
INSERT INTO `country` VALUES ('257', '236', 'Kashima', 'KSJ');
INSERT INTO `country` VALUES ('258', '236', 'Kawasaki', 'KWS');
INSERT INTO `country` VALUES ('259', '236', 'Kobe', 'UKB');
INSERT INTO `country` VALUES ('260', '236', 'Kochi', 'KCZ');
INSERT INTO `country` VALUES ('261', '236', 'Kumamoto', 'KMJ');
INSERT INTO `country` VALUES ('262', '236', 'Kushiro', 'KUH');
INSERT INTO `country` VALUES ('263', '236', 'Maizuru', 'MAI');
INSERT INTO `country` VALUES ('264', '236', 'Matsuyama', 'MYJ');
INSERT INTO `country` VALUES ('265', '236', 'Mizushima', 'MIZ');
INSERT INTO `country` VALUES ('266', '236', 'Moji', 'MOJ');
INSERT INTO `country` VALUES ('267', '236', 'Muroran', 'MUR');
INSERT INTO `country` VALUES ('268', '236', 'Nagasaki', 'NGS');
INSERT INTO `country` VALUES ('269', '236', 'Nagoya', 'NGO');
INSERT INTO `country` VALUES ('270', '236', 'Nakanoseki', 'NAN');
INSERT INTO `country` VALUES ('271', '236', 'Naoetsu', 'NAO');
INSERT INTO `country` VALUES ('272', '236', 'Niigata', 'KIJ');
INSERT INTO `country` VALUES ('273', '236', 'Oita', 'OIT');
INSERT INTO `country` VALUES ('274', '236', 'Omaezaki', 'OMZ');
INSERT INTO `country` VALUES ('275', '236', 'Onahama', 'ONA');
INSERT INTO `country` VALUES ('276', '236', 'Osaka', 'OSA');
INSERT INTO `country` VALUES ('277', '236', 'Sakai', 'SAK');
INSERT INTO `country` VALUES ('278', '236', 'Sakaiminato', 'SMN');
INSERT INTO `country` VALUES ('279', '236', 'Sakata', 'SKT');
INSERT INTO `country` VALUES ('280', '236', 'Sendai', 'SDJ');
INSERT INTO `country` VALUES ('281', '236', 'Shibushi', 'SBS');
INSERT INTO `country` VALUES ('282', '236', 'Shimizu', 'SMZ');
INSERT INTO `country` VALUES ('283', '236', 'Takamatsu', 'TAK');
INSERT INTO `country` VALUES ('284', '236', 'Tokushima', 'TKS');
INSERT INTO `country` VALUES ('285', '236', 'Tokuyama', 'TKY');
INSERT INTO `country` VALUES ('286', '236', 'Tokyo', 'TYO');
INSERT INTO `country` VALUES ('287', '236', 'Tomakomai', 'TMK');
INSERT INTO `country` VALUES ('288', '236', 'Toyamashinko', 'TOS');
INSERT INTO `country` VALUES ('289', '236', 'Toyohashi', 'THS');
INSERT INTO `country` VALUES ('290', '236', 'Tsuruga', 'TRG');
INSERT INTO `country` VALUES ('291', '236', 'Yatsushiro', 'YAT');
INSERT INTO `country` VALUES ('292', '236', 'Yokkaichi', 'YKK');
INSERT INTO `country` VALUES ('293', '236', 'Yokohama', 'YOK');
INSERT INTO `country` VALUES ('294', '0', 'Kenya', 'KE');
INSERT INTO `country` VALUES ('295', '294', 'Icd Embakasi ', 'EMK');
INSERT INTO `country` VALUES ('296', '294', 'Icd Naivasha', 'NSH');
INSERT INTO `country` VALUES ('297', '294', 'Mombasa', 'MBA');
INSERT INTO `country` VALUES ('298', '0', 'Korea', 'KR');
INSERT INTO `country` VALUES ('299', '298', 'Busan', 'PUS');
INSERT INTO `country` VALUES ('300', '298', 'Ansan', 'ASN');
INSERT INTO `country` VALUES ('301', '298', 'Bugok', 'BGK');
INSERT INTO `country` VALUES ('302', '298', 'Daesan', 'DSN');
INSERT INTO `country` VALUES ('303', '298', 'Incheon', 'INC');
INSERT INTO `country` VALUES ('304', '298', 'Kwangyang', 'KAN');
INSERT INTO `country` VALUES ('305', '298', 'Pohang', 'KPO');
INSERT INTO `country` VALUES ('306', '298', 'Pyeongtaek', 'PTK');
INSERT INTO `country` VALUES ('307', '298', 'Ulsan', 'USN');
INSERT INTO `country` VALUES ('308', '0', 'Kuwait', 'KW');
INSERT INTO `country` VALUES ('309', '308', 'Shuaiba', 'SAA');
INSERT INTO `country` VALUES ('310', '308', 'Shuwaikh', 'KWI');
INSERT INTO `country` VALUES ('311', '0', 'Malaysia', 'MY');
INSERT INTO `country` VALUES ('312', '311', 'Bintulu', 'BMS');
INSERT INTO `country` VALUES ('313', '311', 'Kota Kinabalu', 'BKI');
INSERT INTO `country` VALUES ('314', '311', 'Kuching', 'KCH');
INSERT INTO `country` VALUES ('315', '311', 'Pasir Gudang', 'PGU');
INSERT INTO `country` VALUES ('316', '311', 'Penang', 'PEN');
INSERT INTO `country` VALUES ('317', '311', 'Port Kelang Northport', 'PKG');
INSERT INTO `country` VALUES ('318', '311', 'Port Kelang Westport', 'PKW');
INSERT INTO `country` VALUES ('319', '311', 'Tanjung Pelapas', 'TPP');
INSERT INTO `country` VALUES ('320', '311', 'Tanjung Pelepas', 'PTP');
INSERT INTO `country` VALUES ('321', '0', 'Myanmar', 'MM');
INSERT INTO `country` VALUES ('322', '321', 'Yangon', 'RGN');
INSERT INTO `country` VALUES ('323', '0', 'Nepal', 'NP');
INSERT INTO `country` VALUES ('324', '323', 'Icd Birgunj', 'BGJ');
INSERT INTO `country` VALUES ('325', '0', 'Oman', 'OM');
INSERT INTO `country` VALUES ('326', '325', 'Sohar', 'SOH');
INSERT INTO `country` VALUES ('327', '0', 'Pakistan', 'PK');
INSERT INTO `country` VALUES ('328', '327', 'Karachi', 'KHI');
INSERT INTO `country` VALUES ('329', '0', 'Philippines', 'PH');
INSERT INTO `country` VALUES ('330', '329', 'General Santos', 'GES');
INSERT INTO `country` VALUES ('331', '329', 'North Manila', 'MIP');
INSERT INTO `country` VALUES ('332', '329', 'South Manila', 'MNL');
INSERT INTO `country` VALUES ('333', '329', 'Zamboanga', 'ZAM');
INSERT INTO `country` VALUES ('334', '0', 'Qatar', 'QA');
INSERT INTO `country` VALUES ('335', '334', 'Doha', 'DHA');
INSERT INTO `country` VALUES ('336', '334', 'Hamad', 'HMA');
INSERT INTO `country` VALUES ('337', '0', 'Russia', 'RU');
INSERT INTO `country` VALUES ('338', '337', 'Vladivostok Maritime Port Pervomaysky', 'VMP');
INSERT INTO `country` VALUES ('339', '337', 'Vladivostok Vostokmorservice', 'VMS');
INSERT INTO `country` VALUES ('340', '337', 'Vladivostok', 'VVO');
INSERT INTO `country` VALUES ('341', '337', 'Vostochnyy', 'VYP');
INSERT INTO `country` VALUES ('342', '0', 'Saudi Arabia', 'SA');
INSERT INTO `country` VALUES ('343', '342', 'Dammam', 'DMM');
INSERT INTO `country` VALUES ('344', '342', 'Jeddah', 'JED');
INSERT INTO `country` VALUES ('345', '342', 'Jubail', 'JUB');
INSERT INTO `country` VALUES ('346', '342', 'Riyadh', 'RUH');
INSERT INTO `country` VALUES ('347', '0', 'Singapore', 'SG');
INSERT INTO `country` VALUES ('348', '347', 'Singapore', 'SIN');
INSERT INTO `country` VALUES ('349', '0', 'Sri Lanka', 'LK');
INSERT INTO `country` VALUES ('350', '349', 'Colombo', 'CMB');
INSERT INTO `country` VALUES ('351', '0', 'Taiwan', 'TW');
INSERT INTO `country` VALUES ('352', '351', 'Kaohsiung', 'KHH');
INSERT INTO `country` VALUES ('353', '351', 'Keelung', 'KEL');
INSERT INTO `country` VALUES ('354', '351', 'Taichung', 'TXG');
INSERT INTO `country` VALUES ('355', '351', 'Taoyuan', 'TYN');
INSERT INTO `country` VALUES ('356', '0', 'Thailand', 'TH');
INSERT INTO `country` VALUES ('357', '356', 'Bandon', 'BNN');
INSERT INTO `country` VALUES ('358', '356', 'Bangkok Modern Terminal', 'BMT');
INSERT INTO `country` VALUES ('359', '356', 'Bangkok', 'BKK');
INSERT INTO `country` VALUES ('360', '356', 'Laem Chabang', 'LCH');
INSERT INTO `country` VALUES ('361', '356', 'Latkrabang', 'LKB');
INSERT INTO `country` VALUES ('362', '356', 'Siam Container Terminal', 'SCT');
INSERT INTO `country` VALUES ('363', '356', 'Songkhla', 'SGZ');
INSERT INTO `country` VALUES ('364', '356', 'Thai Prosperity Terminal', 'TPT');
INSERT INTO `country` VALUES ('365', '0', 'United Arab Emirates', 'AE');
INSERT INTO `country` VALUES ('366', '365', 'Abu Dhabi', 'AUH');
INSERT INTO `country` VALUES ('367', '365', 'Ajman', 'AJM');
INSERT INTO `country` VALUES ('368', '365', 'Jebel Ali', 'JEA');
INSERT INTO `country` VALUES ('369', '365', 'Khor Fakhan', 'KLF');
INSERT INTO `country` VALUES ('370', '365', 'Ras Al Khaimah', 'RAK');
INSERT INTO `country` VALUES ('371', '365', 'Sharjah', 'SHJ');
INSERT INTO `country` VALUES ('372', '365', 'Sharjah Icd', 'SHC');
INSERT INTO `country` VALUES ('373', '365', 'Umm Al Qaiwain', 'QIW');
INSERT INTO `country` VALUES ('374', '0', 'Vietnam', 'VN');
INSERT INTO `country` VALUES ('375', '374', 'Cai Mep', 'CMP');
INSERT INTO `country` VALUES ('376', '374', 'Haiphong', 'HPH');
INSERT INTO `country` VALUES ('377', '374', 'Hanoi', 'HAN');
INSERT INTO `country` VALUES ('378', '374', 'Hochiminh', 'SGN');
INSERT INTO `country` VALUES ('379', '374', 'Icd Gia Lam ', 'GLM');
INSERT INTO `country` VALUES ('380', '374', 'Icd My Dinh', 'MDN');
INSERT INTO `country` VALUES ('381', '374', 'Icd Song Than', 'ISN');
INSERT INTO `country` VALUES ('382', '374', 'Icd Sotrans', 'IST');
INSERT INTO `country` VALUES ('383', '374', 'Icd Transimex', 'ITX');
INSERT INTO `country` VALUES ('384', '374', 'Khanh Hoi', 'KHA');
INSERT INTO `country` VALUES ('385', '374', 'My Dinh', 'IMD');
INSERT INTO `country` VALUES ('386', '374', 'Phuoc Long Icd', 'IPL');
INSERT INTO `country` VALUES ('387', '374', 'Spitc', 'SPC');
INSERT INTO `country` VALUES ('388', '374', 'Tan Cang Cai Mep', 'TCC');
INSERT INTO `country` VALUES ('389', '374', 'Vict', 'VIT');

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES ('1', null, '行政', null);
INSERT INTO `department` VALUES ('2', null, '财务', null);
INSERT INTO `department` VALUES ('3', '2', '财务1', null);
INSERT INTO `department` VALUES ('4', '2', '财务2', null);
INSERT INTO `department` VALUES ('5', null, '业务', null);
INSERT INTO `department` VALUES ('6', '5', '业务1', null);
INSERT INTO `department` VALUES ('7', '5', '业务2', null);
INSERT INTO `department` VALUES ('8', null, '其他', null);
INSERT INTO `department` VALUES ('9', null, 'system', null);

-- ----------------------------
-- Table structure for option
-- ----------------------------
DROP TABLE IF EXISTS `option`;
CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `select_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `extra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of option
-- ----------------------------
INSERT INTO `option` VALUES ('1', '3', 'DR/40/HQ', 'DR/40/HQ', null);
INSERT INTO `option` VALUES ('2', '3', 'DR/20/SD', 'DR/20/SD', null);
INSERT INTO `option` VALUES ('3', '3', 'DR/40/SD', 'DR/40/SD', null);
INSERT INTO `option` VALUES ('4', '3', 'OT/20/SD', 'OT/20/SD', null);
INSERT INTO `option` VALUES ('5', '3', 'OT/40/SD', 'OT/40/SD', null);
INSERT INTO `option` VALUES ('6', '3', 'RF/20/SD', 'RF/20/SD', null);
INSERT INTO `option` VALUES ('8', '4', 'C&F', 'C&F', 'FOB');
INSERT INTO `option` VALUES ('9', '4', 'CIF', 'CIF', 'CFR');
INSERT INTO `option` VALUES ('10', '4', 'FOB', 'FOB', 'CIF');
INSERT INTO `option` VALUES ('12', '5', 'BEN LINE AGENCIES (JAPAN) Ltd.', 'BEN LINE AGENCIES (JAPAN) Ltd.', 'BEN　LINE');
INSERT INTO `option` VALUES ('13', '5', 'COSCO　SHIOOING LINES', 'COSCO　SHIOOING LINES', 'COSCO　');
INSERT INTO `option` VALUES ('14', '5', 'DONGJIN AGENCY CO., LTD.', 'DONGJIN AGENCY CO., LTD.', 'DONGJIN AGENCY');
INSERT INTO `option` VALUES ('15', '5', 'EASTERN CAR LINER, LTD', 'EASTERN CAR LINER, LTD', 'ECL');
INSERT INTO `option` VALUES ('16', '5', 'EVERGREEN LINE', 'EVERGREEN LINE', 'EVERGREEN');
INSERT INTO `option` VALUES ('17', '5', 'INTERSIA LINES LTD.', 'INTERSIA LINES LTD.', 'INTERSIA');
INSERT INTO `option` VALUES ('18', '5', 'KMTC(JAPAN) CO.LTD.', 'KMTC(JAPAN) CO.LTD.', 'KMTC');
INSERT INTO `option` VALUES ('19', '5', 'MAERSK JAPAN', 'MAERSK JAPAN', 'MAERSK');
INSERT INTO `option` VALUES ('20', '5', 'NAMSUNG SHIPPING JAPAN, LTD.', 'NAMSUNG SHIPPING JAPAN, LTD.', 'NAMSUNG');
INSERT INTO `option` VALUES ('21', '5', 'SINOKOR SEIHON', 'SINOKOR SEIHON', 'SINOKOR');
INSERT INTO `option` VALUES ('22', '5', 'SINOTRANS JAPAN CO.,LTD.', 'SINOTRANS JAPAN CO.,LTD.', 'SINOTRANS');
INSERT INTO `option` VALUES ('23', '5', 'STAR OCEAN MARINE', 'STAR OCEAN MARINE', 'STAR OCEAN');
INSERT INTO `option` VALUES ('24', '5', 'SITC JAPAN', 'SITC JAPAN', 'STIC');
INSERT INTO `option` VALUES ('25', '5', 'TS LINES JAPAN', 'TS LINES JAPAN', 'TS LINE');
INSERT INTO `option` VALUES ('26', '5', 'WAN HAI LINES LTD.', 'WAN HAI LINES LTD.', 'WAN HAI');
INSERT INTO `option` VALUES ('27', '5', 'YANG MING MARINE TRANSPORT CORP.', 'YANG MING MARINE TRANSPORT CORP.', 'YANG MING');
INSERT INTO `option` VALUES ('33', '6', 'BOOKINGのみ　', 'BOOKINGのみ　', null);
INSERT INTO `option` VALUES ('34', '6', '通関のみ', '通関のみ', null);
INSERT INTO `option` VALUES ('35', '6', 'ドレージのみ', 'ドレージのみ', null);
INSERT INTO `option` VALUES ('36', '6', '通・BK', '通・BK', null);
INSERT INTO `option` VALUES ('37', '6', '通・ド', '通・ド', null);
INSERT INTO `option` VALUES ('38', '6', '通・ド・BK', '通・ド・BK', null);
INSERT INTO `option` VALUES ('39', '6', 'BK・ド    ', 'BK・ド    ', null);
INSERT INTO `option` VALUES ('55', '7', '極東', '極東', '杉原');
INSERT INTO `option` VALUES ('56', '7', '国際エキス神戸', '国際エキス神戸', '正木');
INSERT INTO `option` VALUES ('57', '7', '新和ロジ', '新和ロジ', '友重');
INSERT INTO `option` VALUES ('58', '7', 'ジェネック', 'ジェネック', '三良');
INSERT INTO `option` VALUES ('59', '7', 'グリーン', 'グリーン', '熊原');
INSERT INTO `option` VALUES ('60', '7', '日本ロジ', '日本ロジ', '鈴木');
INSERT INTO `option` VALUES ('61', '7', 'アリス', 'アリス', '佐藤');
INSERT INTO `option` VALUES ('62', '7', 'ミック', 'ミック', '高木');
INSERT INTO `option` VALUES ('63', '7', '大藤', '大藤', '西村');
INSERT INTO `option` VALUES ('64', '7', '山九', '山九', '星野');
INSERT INTO `option` VALUES ('65', '7', '日通', '日通', '田端');
INSERT INTO `option` VALUES ('66', '7', 'ナラサキ', 'ナラサキ', '加藤');
INSERT INTO `option` VALUES ('67', '7', '秋田海陸', '秋田海陸', '星島　');
INSERT INTO `option` VALUES ('68', '7', '国際エキス大阪', '国際エキス大阪', '陳');
INSERT INTO `option` VALUES ('69', '9', '株式会社 中部シーカーゴ ', '株式会社 中部シーカーゴ ', '南川 英樹');
INSERT INTO `option` VALUES ('70', '9', '大藤運輸株式会社', '大藤運輸株式会社', '西村');
INSERT INTO `option` VALUES ('71', '9', '株式会社 巳翠', '株式会社 巳翠', '');
INSERT INTO `option` VALUES ('72', '9', '日本通運　石狩', '日本通運　石狩', '田端');
INSERT INTO `option` VALUES ('73', '9', 'ナラサキスタックス株式会社', 'ナラサキスタックス株式会社', '宮腰　悠太');
INSERT INTO `option` VALUES ('74', '9', '極東海運', '極東海運', '杉原');
INSERT INTO `option` VALUES ('75', '9', '東海運', '東海運', '');
INSERT INTO `option` VALUES ('76', '9', '富山港湾運送株式会社', '富山港湾運送株式会社', '二口');
INSERT INTO `option` VALUES ('77', '3', 'RF/40/SD', 'RF/40/SD', null);
INSERT INTO `option` VALUES ('78', '3', 'FR/20/SD', 'FR/20/SD', null);
INSERT INTO `option` VALUES ('79', '3', 'FR/40/SD', 'FR/40/SD', null);
INSERT INTO `option` VALUES ('80', '3', 'LCL', 'LCL', null);
INSERT INTO `option` VALUES ('81', '10', '通', '通', null);
INSERT INTO `option` VALUES ('82', '10', 'バ', 'バ', null);
INSERT INTO `option` VALUES ('83', '10', '許', '許', null);
INSERT INTO `option` VALUES ('84', '10', 'D', 'D', null);
INSERT INTO `option` VALUES ('85', '10', 'B', 'B', null);
INSERT INTO `option` VALUES ('86', '10', 'S', 'S', null);
INSERT INTO `option` VALUES ('87', '10', '請', '請', null);
INSERT INTO `option` VALUES ('88', '10', '入', '入', null);

-- ----------------------------
-- Table structure for port_of_delovery
-- ----------------------------
DROP TABLE IF EXISTS `port_of_delovery`;
CREATE TABLE `port_of_delovery` (
  `id` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `eta` varchar(255) DEFAULT NULL,
  `free_time_dem` varchar(255) DEFAULT NULL,
  `free_time_det` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of port_of_delovery
-- ----------------------------
INSERT INTO `port_of_delovery` VALUES ('', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16266599169334553', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16266649767842942', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16267513267359986', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16270138748907216', 'AI', 'AI  THE ROAD(AIROA)', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16270141222352616', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16270141750182028', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16270376832708096', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16270534307637831', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16270535283206496', '0', '0', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271126066812858', 'AI', 'AI  SHENGJIN(ALSHG)', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271128755658726', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271138504157557', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271142363214281', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271142434539064', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271142567128958', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271142641706355', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271142678215921', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271142779767467', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271142881567999', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271147026297973', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271147092256618', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271147148384284', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271147316211544', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271147363943417', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271157161942491', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16271229112416787', 'CN', 'CN  SHANGHAI(CNSHA)', '2021-07-27', '123', '333');
INSERT INTO `port_of_delovery` VALUES ('16271806308593044', 'TH', '', '2021-08-07', '5', '5');
INSERT INTO `port_of_delovery` VALUES ('16272020169937649', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272021958477515', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272022318465762', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272024314979778', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272024714508184', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272026628419091', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272026997331010', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272027380258003', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272027605523467', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272027637046981', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272027662371113', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272028086205420', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272028222603758', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272028758984759', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272029302382562', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272036310489386', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272042648433625', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272043119729372', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272044072152239', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272044633515150', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272044717432299', '', '', '', '', '');
INSERT INTO `port_of_delovery` VALUES ('16272087938192580', '', '', '', '', '');

-- ----------------------------
-- Table structure for port_of_loading
-- ----------------------------
DROP TABLE IF EXISTS `port_of_loading`;
CREATE TABLE `port_of_loading` (
  `id` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `eta` varchar(255) DEFAULT NULL,
  `etd` varchar(255) DEFAULT NULL,
  `cy_open` varchar(255) DEFAULT NULL,
  `cy_cut` varchar(255) DEFAULT NULL,
  `doc_cut` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of port_of_loading
-- ----------------------------
INSERT INTO `port_of_loading` VALUES ('', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16266599169334553', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16266649767842942', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16267513267359986', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16270138748907216', 'AI', 'AI  SARANDE(ALSAR)', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16270141222352616', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16270141750182028', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16270376832708096', 'AI', 'AI  OTHER(AIZZZ)', '2021-07-29', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16270534307637831', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16270535283206496', '0', '0', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271126066812858', 'CN', 'CN  ZHUHAI(CNZUH)', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271128755658726', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271138504157557', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271142363214281', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271142434539064', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271142567128958', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271142641706355', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271142678215921', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271142779767467', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271142881567999', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271147026297973', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271147092256618', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271147148384284', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271147316211544', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271147363943417', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271157161942491', 'AF', 'AF  FARAH(AFFAH)', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16271229112416787', 'AG', 'AG  ANTIGUA(AGANU)', '2021-07-27', '2021-07-25', '2021-07-07', '2021-07-20', '2021-07-23');
INSERT INTO `port_of_loading` VALUES ('16271806308593044', 'JP', '', '2021-07-28', '2021-07-28', '2021-07-22', '2021-07-27', '2021-07-27');
INSERT INTO `port_of_loading` VALUES ('16272020169937649', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272021958477515', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272022318465762', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272024314979778', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272024714508184', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272026628419091', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272026997331010', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272027380258003', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272027605523467', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272027637046981', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272027662371113', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272028086205420', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272028222603758', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272028758984759', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272029302382562', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272036310489386', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272042648433625', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272043119729372', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272044072152239', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272044633515150', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272044717432299', '', '', '', '', '', '', '');
INSERT INTO `port_of_loading` VALUES ('16272087938192580', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for prot_of_delovery
-- ----------------------------
DROP TABLE IF EXISTS `prot_of_delovery`;
CREATE TABLE `prot_of_delovery` (
  `id` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `eta` varchar(255) DEFAULT NULL,
  `free_time_dem` varchar(255) DEFAULT NULL,
  `free_time_det` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of prot_of_delovery
-- ----------------------------

-- ----------------------------
-- Table structure for select
-- ----------------------------
DROP TABLE IF EXISTS `select`;
CREATE TABLE `select` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of select
-- ----------------------------
INSERT INTO `select` VALUES ('1', 'user', 'user');
INSERT INTO `select` VALUES ('2', 'country', 'country');
INSERT INTO `select` VALUES ('3', 'container', '');
INSERT INTO `select` VALUES ('4', 'incoterms', '');
INSERT INTO `select` VALUES ('5', 'carrier', '');
INSERT INTO `select` VALUES ('6', 'bkg_type', '');
INSERT INTO `select` VALUES ('7', 'forwarder', '');
INSERT INTO `select` VALUES ('8', 'booker', 'booker');
INSERT INTO `select` VALUES ('9', '运送', '');
INSERT INTO `select` VALUES ('10', 'state', '');

-- ----------------------------
-- Table structure for shipper
-- ----------------------------
DROP TABLE IF EXISTS `shipper`;
CREATE TABLE `shipper` (
  `id` varchar(255) NOT NULL,
  `carrier` varchar(255) DEFAULT NULL,
  `c_staff` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `vessel_name` varchar(255) DEFAULT NULL,
  `voyage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of shipper
-- ----------------------------
INSERT INTO `shipper` VALUES ('', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16266599169334553', 'COSCO　SHIOOING LINES', '2', '1', '', '1');
INSERT INTO `shipper` VALUES ('16266649767842942', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16267513267359986', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16270138748907216', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16270141222352616', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16270141750182028', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16270376832708096', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16270534307637831', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16270535283206496', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271126066812858', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271128755658726', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271138504157557', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271142363214281', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271142434539064', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271142567128958', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271142641706355', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271142678215921', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271142779767467', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271142881567999', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271147026297973', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271147092256618', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271147148384284', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271147316211544', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271147363943417', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271157161942491', 'EVERGREEN LINE', '', '', '', '');
INSERT INTO `shipper` VALUES ('16271229112416787', 'EVERGREEN LINE', '发定位服务', 'e\'f\'w', '发w\'f', ' 范文芳');
INSERT INTO `shipper` VALUES ('16271806308593044', 'WAN HAI LINES LTD.', '', 'JSV', 'WAN HAI 173', 'S061');
INSERT INTO `shipper` VALUES ('16272020169937649', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272021958477515', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272022318465762', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272024314979778', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272024714508184', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272026628419091', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272026997331010', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272027380258003', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272027605523467', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272027637046981', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272027662371113', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272028086205420', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272028222603758', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272028758984759', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272029302382562', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272036310489386', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272042648433625', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272043119729372', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272044072152239', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272044633515150', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272044717432299', '', '', '', '', '');
INSERT INTO `shipper` VALUES ('16272087938192580', '', '', '', '', '');

-- ----------------------------
-- Table structure for table_config
-- ----------------------------
DROP TABLE IF EXISTS `table_config`;
CREATE TABLE `table_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `table_name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `col_name` varchar(255) NOT NULL,
  `params_name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `default` varchar(255) DEFAULT NULL,
  `order` int(10) unsigned DEFAULT '0',
  `enable` int(11) DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of table_config
-- ----------------------------
INSERT INTO `table_config` VALUES ('1', null, 'bkg', 'BKG DATE', 'bkg_date', 'bkgDate', 'date', 'today', '1', '1');
INSERT INTO `table_config` VALUES ('2', null, 'bkg', 'BKG  NO.', 'bkg_no', 'nkgNo', 'linkDefault', null, '2', '1');
INSERT INTO `table_config` VALUES ('3', '2', 'bkg', 'B/L NO, ', 'bl_no', 'blNo', 'linkDefault', null, '3', '1');
INSERT INTO `table_config` VALUES ('4', null, 'bkg', 'BKG STAFF', 'bkg_staff', 'bkgStaff', 'userSelect', 'loginUser', '5', '1');
INSERT INTO `table_config` VALUES ('5', null, 'bkg', 'IN SALES', 'in_sales', 'inSales', 'userSelect', null, '6', '1');
INSERT INTO `table_config` VALUES ('6', null, 'bkg', 'DG', 'dg', 'dg', 'text', null, '7', '1');
INSERT INTO `table_config` VALUES ('7', null, 'bkg', 'BKG type', 'bkg_type', 'bkgType', 'select', null, '4', '1');
INSERT INTO `table_config` VALUES ('8', null, 'trader', 'BOOKER', 'booker', 'booker', 'linkSelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('9', '8', 'trader', 'B/STAFF', 'bStaff', 'b_staff', 'linkSuggest', null, '0', '1');
INSERT INTO `table_config` VALUES ('10', null, 'trader', 'SHIPPER', 'shipper', 'shipper', 'text', null, '0', '1');
INSERT INTO `table_config` VALUES ('11', null, 'trader', 'FORWARDER', 'forwarder', 'forwarder', 'linkSelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('12', '11', 'trader', 'F/STAFF', 'fStaff', 'f_staff', 'linkSuggest', null, '0', '1');
INSERT INTO `table_config` VALUES ('13', null, 'trader', 'CONSIGNEE', 'consignee', 'consignee', 'text', null, '0', '1');
INSERT INTO `table_config` VALUES ('14', null, 'trader', 'DRAYAGE', 'daryage', 'daryage', 'linkSelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('15', '14', 'trader', 'D/STAFF', 'dStaff', 'd_staff', 'linkSuggest', null, '0', '1');
INSERT INTO `table_config` VALUES ('16', null, 'shipper', 'CARRIER', 'carrier', 'carrier', 'linkSelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('17', '16', 'shipper', 'C/STAFF', 'cStaff', 'c_staff', 'linkSuggest', null, '0', '1');
INSERT INTO `table_config` VALUES ('18', null, 'shipper', 'SERVICE', 'service', 'service', 'text', null, '0', '1');
INSERT INTO `table_config` VALUES ('19', null, 'shipper', 'VESSEL NAME', 'vesselName', 'vessel_name', 'linkSelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('20', '19', 'shipper', 'VOYAGE', 'voyage', 'voyage', 'linkSuggest', null, '0', '1');
INSERT INTO `table_config` VALUES ('21', null, 'port_of_loading', 'COUNTRY', 'country', 'country', 'countrySelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('22', '21', 'port_of_loading', 'PORT', 'port', 'port', 'countrySelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('23', null, 'port_of_loading', 'ETA', 'eta', 'eta', 'date', null, '0', '1');
INSERT INTO `table_config` VALUES ('24', null, 'port_of_loading', 'ETD', 'etd', 'etd', 'date', null, '0', '1');
INSERT INTO `table_config` VALUES ('25', null, 'port_of_loading', 'CY OPEN', 'cyOpen', 'cy_open', 'date', null, '0', '1');
INSERT INTO `table_config` VALUES ('26', null, 'port_of_loading', 'CY CUT', 'cyCut', 'cy_cut', 'date', null, '0', '1');
INSERT INTO `table_config` VALUES ('27', null, 'port_of_loading', 'DOC_CUT', 'docCut', 'doc_cut', 'date', null, '0', '1');
INSERT INTO `table_config` VALUES ('28', null, 'port_of_delovery', 'COUNTRY', 'country', 'country', 'countrySelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('29', '28', 'port_of_delovery', 'PORT', 'port', 'port', 'countrySelect', null, '0', '1');
INSERT INTO `table_config` VALUES ('30', null, 'port_of_delovery', 'ETA', 'eta', 'eta', 'date', null, '0', '1');
INSERT INTO `table_config` VALUES ('31', null, 'port_of_delovery', 'FREE TIME DEM', 'freeTimeDem', 'free_time_dem', 'number', null, '0', '1');
INSERT INTO `table_config` VALUES ('32', null, 'port_of_delovery', 'FREE TIME DET', 'freeTimeDet', 'free_time_det', 'number', null, '0', '1');
INSERT INTO `table_config` VALUES ('33', null, 'container', 'COMMON', 'common', 'common', 'text', null, '0', '1');
INSERT INTO `table_config` VALUES ('34', null, 'container', 'VAN PLACE', 'vanPlace', 'van_place', 'suggest', null, '0', '1');
INSERT INTO `table_config` VALUES ('35', null, 'container', '備考', 'remarks', 'remarks', 'textarea', null, '0', '1');
INSERT INTO `table_config` VALUES ('36', null, 'container_type', null, 'containerType', 'container_type', 'select', null, '0', '1');
INSERT INTO `table_config` VALUES ('37', null, 'container_type', null, 'quanity', 'quanity', 'number', null, '0', '1');
INSERT INTO `table_config` VALUES ('38', null, 'container_detail', 'containerType', 'containerType', 'container_type', 'select', null, '0', '1');
INSERT INTO `table_config` VALUES ('39', null, 'container_detail', 'common', 'common', 'common', 'text', null, '1', '1');
INSERT INTO `table_config` VALUES ('40', null, 'container_detail', 'option', 'option', 'option', 'text', null, '2', '1');
INSERT INTO `table_config` VALUES ('41', null, 'container_detail', 'expenses', 'expenses', 'expenses', 'text', null, '3', '1');
INSERT INTO `table_config` VALUES ('42', null, 'container_detail', 'transprotation', 'transprotation', 'transprotation', 'linkselect', null, '4', '1');
INSERT INTO `table_config` VALUES ('43', '42', 'container_detail', 'transprotation', 'charge', 'charge', 'linkselect', null, '5', '1');
INSERT INTO `table_config` VALUES ('44', null, 'container_detail', 'field', 'field', 'field', 'select', null, '6', '1');
INSERT INTO `table_config` VALUES ('45', null, 'container_detail', 'chassis', 'chassis', 'chassis', 'select', null, '8', '1');
INSERT INTO `table_config` VALUES ('46', null, 'container_detail', 'booker_place', 'booker_place', 'booker_place', 'text', null, '9', '1');
INSERT INTO `table_config` VALUES ('47', null, 'container_detail', 'vanning_date', 'vanning_date', 'vanning_date', 'date', null, '10', '1');
INSERT INTO `table_config` VALUES ('48', null, 'container_detail', 'vanning_during', 'vanning_during', 'vanning_during', 'timeRange', null, '11', '1');
INSERT INTO `table_config` VALUES ('49', null, 'container_detail', 'contact', 'contact', 'contact', 'select', null, '7', '1');

-- ----------------------------
-- Table structure for table_config_detail
-- ----------------------------
DROP TABLE IF EXISTS `table_config_detail`;
CREATE TABLE `table_config_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `config_id` int(11) NOT NULL,
  `col` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `enable` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of table_config_detail
-- ----------------------------

-- ----------------------------
-- Table structure for table_select
-- ----------------------------
DROP TABLE IF EXISTS `table_select`;
CREATE TABLE `table_select` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(255) NOT NULL,
  `col` varchar(255) NOT NULL,
  `option_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of table_select
-- ----------------------------
INSERT INTO `table_select` VALUES ('1', 'bkg', 'bkg_staff', '1');

-- ----------------------------
-- Table structure for trader
-- ----------------------------
DROP TABLE IF EXISTS `trader`;
CREATE TABLE `trader` (
  `id` varchar(255) NOT NULL,
  `booker` varchar(255) DEFAULT NULL,
  `b_staff` varchar(255) DEFAULT NULL,
  `shipper` varchar(255) DEFAULT NULL,
  `forwarder` varchar(255) DEFAULT NULL,
  `f_staff` varchar(255) DEFAULT NULL,
  `consignee` varchar(255) DEFAULT NULL,
  `drayage` varchar(255) DEFAULT NULL,
  `d_staff` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of trader
-- ----------------------------
INSERT INTO `trader` VALUES ('', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16266599169334553', '', '234', '', '', '11', '', '', '11', null, null, '2021-07-19 12:39:58');
INSERT INTO `trader` VALUES ('16266649767842942', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16267513267359986', '萬和貿易 株式会社', '熊様', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16270138748907216', '有限会社 中信実業通商', '李様', '', '新和ロジ', '友重', '', '', '', null, null, '2021-07-24 13:59:54');
INSERT INTO `trader` VALUES ('16270141222352616', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16270141750182028', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16270376832708096', '有限会社 中信実業通商', '李様', '是的', '国際エキス神戸', '正木', '爱迪生', '阿迪', '', null, null, '2021-07-23 19:53:17');
INSERT INTO `trader` VALUES ('16270534307637831', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16270535283206496', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271126066812858', '無錫興産 株式会社', '王様', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271128755658726', 'サンゴールド 株式会社', '知念様', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271138504157557', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271142363214281', '有限会社 中信実業通商', '李様', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271142434539064', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271142567128958', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271142641706355', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271142678215921', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271142779767467', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271142881567999', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271147026297973', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271147092256618', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271147148384284', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271147316211544', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271147363943417', '', '', '', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271157161942491', '新南 株式会社', '佐野様', '', '国際エキス神戸', '正木', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16271229112416787', '株式会社 東盛', '深堀様', '分为氛围', 'ジェネック', '三良', '而服务服务', '21312', '12313', null, null, null);
INSERT INTO `trader` VALUES ('16271806308593044', '株式会社 再資源', '金様', '荷主名がBOOKERと異なる場合のみ、記入してください。', '国際エキス大阪', '陳', 'TOP WIN IMPORT & EXPORT CO., LTD.', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272020169937649', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272021958477515', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272022318465762', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272024314979778', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272024714508184', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272026628419091', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272026997331010', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272027380258003', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272027605523467', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272027637046981', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272027662371113', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272028086205420', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272028222603758', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272028758984759', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272029302382562', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272036310489386', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272042648433625', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272043119729372', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272044072152239', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272044633515150', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272044717432299', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);
INSERT INTO `trader` VALUES ('16272087938192580', '', '', '荷主名がBOOKERと異なる場合のみ、記入してください。', '', '', '', '', '', null, null, null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tag` char(4) DEFAULT 'K',
  `enable` tinyint(4) unsigned DEFAULT '1',
  `extra2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'root', '123456', '123456', 'K', '1', null);
INSERT INTO `user` VALUES ('2', 'lilei', 'lilei', 'user1', 'K', '1', null);
INSERT INTO `user` VALUES ('3', 'zhanghong', 'zh', 'user2', 'K', '1', null);
INSERT INTO `user` VALUES ('4', 'liuqiang', 'lq', 'user3', 'K', '1', null);
INSERT INTO `user` VALUES ('5', '1', '2', '4', 'K', '1', null);
