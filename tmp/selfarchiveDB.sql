-- MySQL dump 10.13  Distrib 5.5.28, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: selfarchive
-- ------------------------------------------------------
-- Server version	5.5.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citations`
--

DROP TABLE IF EXISTS `citations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `citation` varchar(1000) DEFAULT NULL,
  `jtitle` varchar(255) DEFAULT NULL,
  `issn` varchar(100) DEFAULT NULL,
  `conditions` varchar(10000) DEFAULT NULL,
  `report_choice` varchar(255) DEFAULT NULL,
  `preprint` varchar(100) DEFAULT NULL,
  `postprint` varchar(100) DEFAULT NULL,
  `preprint_restrictions` varchar(1000) DEFAULT NULL,
  `postprint_restrictions` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`person_id`),
  CONSTRAINT `citations_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citations`
--

LOCK TABLES `citations` WRITE;
/*!40000 ALTER TABLE `citations` DISABLE KEYS */;
INSERT INTO `citations` VALUES (21,18,'<p>\r\n	Meyers, T. &ldquo;Promise and Deceit: Pharmakos, Drug Replacement Therapy and the Perils of Experience.&rdquo; Culture, Medicine, &amp; Psychiatry, special issue on &ldquo;Humanness and Modern Psychotropy&ldquo; [in preparation] [PR]</p>\r\n<div>\r\n	Meyers, T., Leonard, L., Ellen, J.M. &ldquo;The Clinic and Elsewhere: Illness, Sexuality and Social Experience Among Young African-American Men in Baltimore, Maryland.&rdquo; Culture, Medicine, &amp; Psychiatry 2004 28 (1): 67-86. [PR]</div>\r\n','Culture, Medicine and Psychiatry','0165-005X','\n        Authors own final version only can be archived\n        Publisher&#39;s version/PDF cannot be used\n        On author&#39;s website or institutional repository\n        On funders designated website/repository after 12 months at the funders request or as a result of legal obligation\n        Published source must be acknowledged\n        Must link to publisher version\n        Set phrase to accompany link to published version (The original publication is available at www.springerlink.com)\n        Articles in some journals can be made Open Access on payment of additional charge\n      ','postprint','can','can','',''),(22,18,'<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<u>Meyers, T.</u> &ldquo;Disappearances: Some Notes at the End of an Ethnography of Addiction.&rdquo; <em>Medical Anthropology Quarterly</em> special issue on &ldquo;What is the Value of Life?&rdquo; [under review] [PR]</p>\r\n<p>\r\n	<u>Meyers, T. </u>&nbsp;&ldquo;Commentary: A few thoughts on &ldquo;A Strange Distance: Towards an Anthropology of Interior Dialogue.&rdquo; <em>Medical Anthropology Quarterly</em> 2011 25 (1): 24-25.</p>\r\n<p>\r\n	<u>Meyers, T.</u> &ldquo;A Turn Towards Dying: Presence, Signature, and the Social Course of Chronic Illness in Urban America.&rdquo; <em>Medical Anthropology </em>2007 26 (3): 205-227. [PR]</p>\r\n','Medical Anthropology Quarterly','0745-5194','\n        On personal website or institutional website\n        On discipline-specific public servers of preprints and/ or postprints\n        Publisher copyright and source must be acknowledged with full citation\n        Non-commercial\n        Publisher&#39;s version/PDF cannot be used\n      ','postprint','can','can','',''),(23,18,'<p>\r\n	Geroulanos, S. and <u>Meyers, T. </u>&ldquo;A Graft, Philosophical and Physiological: Jean-Luc Nancy&rsquo;s <em>L&rsquo;Intrus</em>.&rdquo; <em>Parallax </em>2009 51 (2): 83-96. [PR]</p>\r\n','Parallax','1353-4645','\n        Some individual journals may have policies prohibiting pre-print archiving\n        Pre-print on authors own website, Institutional or Subject Repository\n        Post-print on authors own website, Institutional or Subject Repository\n        Publisher&#39;s version/PDF cannot be used\n        On a non-profit server\n        Published source must be acknowledged\n        Must link to publisher version\n        Set statements to accompany deposits (see policy)\n        Publisher will deposit to PMC on behalf of NIH authors.\n        STM: Science, Technology and Medicine\n        SSH: Social Science and Humanities\n      ','postprint','can','restricted','','\n          12 month embargo for STM, Behavioural Science and Public Health Journals\n          18 month embargo for SSH journals\n        '),(25,18,'<p>\r\n	Ellen, J.M., Jennings, J., Meyers, T., Chung, S., Taylor, R. &ldquo;Perceived Social Cohesion and Prevalence of Sexually Transmitted Diseases.&rdquo; &nbsp;Sexually Transmitted Diseases 2004 31 (2): 117-122. [PR]</p>\r\n','Sexually Transmitted Diseases','0148-5717','\n        Some journals have separate policies, please check with each journal directly\n        Pre-print must be removed upon acceptance for publication\n        Post-print may be deposited in personal website, university&#39;s institutional repository or employers intranet\n        Publisher&#39;s version/PDF cannot be used\n        Must include statement that it is not the final published version\n        Published source must be acknowledged with full citation\n        Must link to publisher version\n        NIH, Wellcome Trust and HHMI authors will have their accepted manuscripts transmitted to PubMed Central on their behalf (see policy for details)\n      ','postprint','can','restricted','','\n          &lt;num&gt;12&lt;/num&gt; &lt;period units=&#34;month&#34;&gt;months&lt;/period&gt; embargo\n        '),(47,18,'<p>\r\n	Geroulanos, S. and Meyers, T. &ldquo;A Graft, Philosophical and Physiological: Jean-Luc Nancy&rsquo;s L&rsquo;Intrus.&rdquo; Parallax 2009 51 (2): 83-96. [PR]</p>\r\n','American Archivist','0360-9081','\n        This publisher&#39;s policies have not been checked by RoMEO.\n        Please contact the publisher for further information if necessary\n      ','publisher','unknown','unknown','',''),(53,18,'<p>\r\n	(THE SECOND ONE THIS TIME) Geroulanos, S. and Meyers, T. &ldquo;A Graft, Philosophical and Physiological: Jean-Luc Nancy&rsquo;s L&rsquo;Intrus.&rdquo; Parallax 2009 51 (2): 83-96. [PR] (THE SECOND ONE THIS TIME)</p>\r\n','American Archivist','0360-9081','\n        This publisher&#39;s policies have not been checked by RoMEO.\n        Please contact the publisher for further information if necessary\n      ','preprint','unknown','unknown','',''),(54,18,'<p>\r\n	Fixed Spelling.</p>\r\n','Annals of Human Biology','0301-4460','\n        Pre-print allowed on author website, institutions intranet, institutional repository\n        Post-print on author website, institutions intranet, institutional or subject repository\n        Publisher copyright and source must be acknowledged with set statement (see policy)\n        On a non-profit server\n        Author&#39;s version only\n        Must link to publisher version\n      ','preprint','can','restricted','','\n          12 month embargo for STM, Behavioural Science and Public Health Journals\n          18 month embargo for SSH journals\n        '),(55,20,'<p>\r\n	Name, Faculty. &nbsp;&quot;Example Article Here&quot;, Example Journal. &nbsp;Citation Information. &nbsp;1/1/2013. &nbsp;</p>\r\n<p>\r\n	Name, Faculty. &nbsp;&quot;Example Article Here, by another name &quot;, Example Journal. &nbsp;Citation Information. &nbsp;2/1/2013. &nbsp;</p>','American Archivist','0360-9081','\n        This publisher&#39;s policies have not been checked by RoMEO.\n        Please contact the publisher for further information if necessary\n      ','publisher','unknown','unknown','',''),(56,20,'<p>\r\n	Name, Faculty. &nbsp;&quot;Example Article Here&quot;, Example Journal. &nbsp;Citation Information. &nbsp;1/1/2013. &nbsp;</p>\r\n<p>\r\n	Name, Faculty. &nbsp;&quot;Example Article Here, by another name &quot;, Example Journal. &nbsp;Citation Information. &nbsp;2/1/2013. &nbsp;</p>','Discourse','0159-6306','\n        Some individual journals may have policies prohibiting pre-print archiving\n        Post-print on author&#39;s personal website, institutional repository or subject-based repository\n        Post-print on author&#39;s personal website, institutional repository or subject-based repository\n        Publisher&#39;s version/PDF cannot be used\n        On a non-profit server\n        Published source must be acknowledged\n        Must link to publisher version\n        Set statements to accompany deposits (see policy)\n        The publisher will deposit in PubMed Central on behalf of NIH authors\n        STM: Science, Technology and Medicine\n        SSH: Social Science and Humanities\n      ','postprint','can','restricted','','\n          12 month embargo for STM, Behavioural Science and Public Health Journals\n          18 month embargo for SSH journals\n        '),(57,20,'<p>\r\n	Name, Faculty. &nbsp;&quot;Example Article Here&quot;, Example Journal. &nbsp;Citation Information. &nbsp;1/1/2013. &nbsp;</p>\r\n<p>\r\n	Name, Faculty. &nbsp;&quot;Example Article Here, by another name &quot;, Example Journal. &nbsp;Citation Information. &nbsp;2/1/2013. &nbsp;</p>','Journal of Nursing Scholarship','1527-6546','\n        Please see former John Wiley &amp;amp; Sons and Blackwell Publishing policies for articles published prior to February 2007\n        Self-archiving rights vary between journals, please check individual journal policies before depositing\n        On author&#39;s personal website, employer&#39;s website, employer&#39;s repository, or free public servers in the subject area\n        Publisher&#39;s version/PDF cannot be used\n        Publisher source must be acknowledged with citation\n        Must link to publisher version with set statement [The definitive version is available at www3.interscience.wiley.com]\n        If OnlineOpen is available, BBSRC, EPSRC, MRC, NERC and STFC authors, may self-archive after 12 months\n        If OnlineOpen is not available, BBSRC, EPSRC, MRC, NERC and STFC authors, may self-archive after 6 months\n        If OnlineOpen is available, AHRC and ESRC authors, may self-archive after 24 months\n        If OnlineOpen is not available, AHRC and ESRC authors, may self-archive after 12 month\n        Publisher last contacted on 03/04/2013\n      ','publisher','can','restricted','','\n          If signed CTA, only allowed with written permission\n          0 to 24 months depending on journal and funding agency requirements\n        '),(58,20,'<p>\r\n	This is my citation</p>','Spine','0362-2436','\n        Some journals have separate policies, please check with each journal directly\n        Pre-print must be removed upon acceptance for publication\n        Post-print may be deposited in personal website, university&#39;s institutional repository or employers intranet\n        Publisher&#39;s version/PDF cannot be used\n        Must include statement that it is not the final published version\n        Published source must be acknowledged with full citation\n        Must link to publisher version\n        NIH, Wellcome Trust and HHMI authors will have their accepted manuscripts transmitted to PubMed Central on their behalf (see policy for details)\n      ','postprint','can','restricted','','\n          &lt;num&gt;12&lt;/num&gt; &lt;period units=&#34;month&#34;&gt;months&lt;/period&gt; embargo\n        '),(59,18,'<p>\r\n	Here is the amazing citation.</p>','American Archivist','0360-9081','\n        This publisher&#39;s policies have not been checked by RoMEO.\n        Please contact the publisher for further information if necessary\n      ','postprint','unknown','unknown','',''),(60,22,'<p class=\"p1\">\r\n	&ldquo;My Manner of Telling the Story: An Interview with Dmitry Krymov,&rdquo; <i>Contemporary Theatre Review, </i>(in press for winter 2014).&nbsp;</p>\r\n<p class=\"p1\">\r\n	&ldquo;The Visual Poetics of Dmitry Krymov&rsquo;s Theatre Laboratory,&rdquo; <i>Contemporary Theatre Review </i>21.3 (August 2011): 340-350.&nbsp;</p>\r\n<p class=\"p1\">\r\n	&ldquo;Its Hour Has Arrived: Rosalia Tolskaya and the &lsquo;Theatre of Players&rsquo; Method,&rdquo; <i>Contemporary Theatre Review </i>18.2 (May 2008): 236-49.&nbsp;</p>','Contemporary Theatre Review','1048-6801','\n        Some individual journals may have policies prohibiting pre-print archiving\n        On author&#39;s personal website, institutional repository or subject-based repository\n        Publisher&#39;s version/PDF cannot be used\n        On a non-profit server\n        Published source must be acknowledged\n        Must link to publisher version\n        Set statements to accompany deposits (see policy)\n        The publisher will deposit in PubMed Central on behalf of NIH authors\n        SSH: Social Science and Humanities\n      ','postprint','can','restricted','','\n          &lt;num&gt;18&lt;/num&gt; &lt;period units=&#34;month&#34;&gt;months&lt;/period&gt; embargo\n        '),(61,22,'<p class=\"p1\">\r\n	&ldquo;What is Hecuba to Them?: Nikolai Gogol&rsquo;s <i>Marriage </i>at the Guthrie Theatre,&rdquo; Intro. &amp; Trans. James Thomas, <i>Theatre Topics </i>3.2 (September 1993): 177-95.&nbsp;</p>','Theatre Topics','1054-8378','\n        On author or departmental server\n        On institutional server (non-commercial, must not directly compete with either the Johns Hopkins University Press or Project Muse, must request prior permission from the publisher)\n        Publisher copyright and source must be acknowledged\n        In open access repositories, such as PubMed Central if required by law\n      ','postprint','can','can','',''),(62,22,'<p class=\"p1\">\r\n	&ldquo;Designers as Director and Performers,&rdquo; <i>S</i><span class=\"s1\"><i>CENE</i></span><i>: A Journal of Space and Scenic Production, </i>(in press for fall 2013).&nbsp;</p>','Scene','2044-3714','\n        Publisher&#39;s version/PDF cannot be used\n        Publisher copyright and source must be acknowledged\n        DOI details to be given where possible\n      ','postprint','can','can','',''),(63,22,'<p class=\"p1\">\r\n	&ldquo;Wilson Barrett&rsquo;s <i>Hamlet</i>,&rdquo; <i>Theatre Journal</i>, 31.4 (December 1982): 479-500.&nbsp;</p>\r\n<p class=\"p1\">\r\n	&ldquo;<i>The Lady from the Sea </i>and <i>Happy Days</i>,&rdquo; <i>Theatre Journal</i>, December 1979, pp. 542-544. London theatre reviews.&nbsp;</p>','Theatre Journal','0192-2882','\n        On author or departmental server\n        On institutional server (non-commercial, must not directly compete with either the Johns Hopkins University Press or Project Muse, must request prior permission from the publisher)\n        Publisher copyright and source must be acknowledged\n        In open access repositories, such as PubMed Central if required by law\n      ','postprint','can','can','','');
/*!40000 ALTER TABLE `citations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (18,'Todd Eugene Meyers',NULL),(19,'Test Person',NULL),(20,'Faculty Name',NULL),(21,'Graham Hukill',NULL),(22,'James Thomas',NULL);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) DEFAULT NULL,
  `report_body` text,
  `cv_body` text,
  PRIMARY KEY (`id`),
  KEY `person_id` (`person_id`),
  CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-01 10:10:46
