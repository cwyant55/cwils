#!/usr/bin/perl

use 5.010;
use utf8;
use XML::LibXML;
use strict;

my $parser = XML::LibXML->new();
my $file = "marc.xml";

my $dom = $parser->parse_file($file);
#my $dom = XML::LibXML->load_xml(location => $file);

#foreach my $book ($dom->findnodes('//book')) {
#    say 'Title: ' , $book->findvalue('./title');
#    say 'Author: ' , $book->findvalue('./author');
#	say "";
#}

foreach my $book ($dom->findnodes('//leader')) {
	say 'Title: ' , $book;
}