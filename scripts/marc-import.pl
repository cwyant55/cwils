#!/usr/bin/perl
use strict;
use DBI;
use XML::LibXML;

# database connection info
my $username = 'root'; # set your MySQL username
my $password = 'root'; # set your MySQL password
my $database = 'ils'; # set your MySQL database name
my $server = 'localhost'; # set your server hostname (probably localhost)

# xml parser info
my $parser = XML::LibXML->new;
my $doc = $parser->parse_file("ebooks.xml");

# find record elements
my @nodes = $doc->findnodes("//marc:record");

# starting barcode for barcode assignment on import
my $barcode = 10020;
my $checkoutlength = "3week";
my $available = "1";
my $format;
my $title;
my $author;
my $desc;
my $dbh;
my $sth;

# gather XML data
foreach my $node (@nodes) {
	$title = $node->findvalue("./marc:datafield[\@tag='245']/marc:subfield[\@code='a']");
	$format = $node->findvalue("./marc:datafield[\@tag='092']/marc:subfield[\@code='a']");
	$desc = $node->findvalue("./marc:datafield[\@tag='500']/marc:subfield[\@code='a']");
	$author = $node->findvalue("./marc:datafield[\@tag='700']/marc:subfield[\@code='a']");
	$barcode =~ ++$barcode;
		
# Connect to database
$dbh = DBI->connect("DBI:mysql:$database;host=$server", $username, $password)
    || die "Could not connect to database: $DBI::errstr";
	
$sth = $dbh->prepare('insert into items (barcode, title, checkoutlength, available, author, format) values (?, ?, ?, ?, ?, ?)')
    || die "$DBI::errstr";
$sth->execute($barcode, $title, $checkoutlength, $available, $author, $format);
	
} # foreach

# Disconnect
$sth->finish;
$dbh->disconnect;
