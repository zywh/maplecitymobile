<?php
$xmlOrig = <<<XML
<?xml version='1.0' encoding='UTF-8' standalone='yes'?><schools>
<marker SCH_NO="892203" SCH_NAME="Applewood Heights Secondary School" lat="43.6072" lng="-79.605" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="945 Bloor St E" SCH_CITY="Mississauga" SCH_POSTALCODE="L4Y2M8" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="901887" SCH_NAME="Applewood School" lat="43.5575" lng="-79.7434" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="3675 THOMAS ST" SCH_CITY="MISSISSAUGA" SCH_POSTALCODE="L5M7E6" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="736228" SCH_NAME="Archbishop Romero Catholic Secondary School" lat="43.6227" lng="-79.6702" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="2495 Credit Valley Road" SCH_CITY="Mississauga" SCH_POSTALCODE="L5M4G8" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="901660" SCH_NAME="Clarkson Secondary School" lat="43.5041" lng="-79.6458" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="2524 Bromsgrove Rd" SCH_CITY="Mississauga" SCH_POSTALCODE="L5J1L8" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="967740" SCH_NAME="Craig Kielburger Secondary School" lat="43.51472" lng="-79.82683" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="1151 Ferguson Drive" SCH_CITY="Milton" SCH_POSTALCODE="L9T7V8" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="907642" SCH_NAME="&#201;cole secondaire Jeunes sans fronti&#232;res" lat="43.624" lng="-79.7588" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="7585 promenade Financial" SCH_CITY="Brampton" SCH_POSTALCODE="L6Y5P4" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="French" FDELP_Flag="NO"/>
 
<marker SCH_NO="909092" SCH_NAME="Erindale Secondary School" lat="43.5388" lng="-79.6666" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="2021 DUNDAS ST" SCH_CITY="MISSISSAUGA" SCH_POSTALCODE="L5K1R2" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="790001" SCH_NAME="&#201;SC Sainte-Famille" lat="43.6147" lng="-79.7478" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="1780 boulevard Meadowvale" SCH_CITY="Mississauga" SCH_POSTALCODE="L5N7K8" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="French" FDELP_Flag="NO"/>
 
<marker SCH_NO="706957" SCH_NAME="Father Michael Goetz Secondary School" lat="43.5819" lng="-79.6358" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="330 Central Pkwy W" SCH_CITY="Mississauga" SCH_POSTALCODE="L5B3K6" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="722790" SCH_NAME="Iona Secondary School" lat="43.5206" lng="-79.6472" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="2170 South Sheridan Way" SCH_CITY="Mississauga" SCH_POSTALCODE="L5J2M4" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="918300" SCH_NAME="Iroquois Ridge High School" lat="43.4886" lng="-79.699" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="1123 Glenashton Dr" SCH_CITY="Oakville" SCH_POSTALCODE="L6H5M1" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="704300" SCH_NAME="Holy Trinity Catholic Secondary School" lat="43.4721" lng="-79.7242" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="2420 Sixth Line" SCH_CITY="Oakville" SCH_POSTALCODE="L6H3N8" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="724564" SCH_NAME="John Cabot Catholic Secondary School" lat="43.6126" lng="-79.6208" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="635 Willowbank Trail" SCH_CITY="Mississauga" SCH_POSTALCODE="L4W3L6" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="918830" SCH_NAME="John Fraser Secondary School" lat="43.56" lng="-79.7167" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="2665 Erin Centre Blvd" SCH_CITY="Mississauga" SCH_POSTALCODE="L5M5H6" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="962646" SCH_NAME="Stephen Lewis Secondary School" lat="43.5574" lng="-79.7437" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="3675 Thomas Street" SCH_CITY="Mississauga" SCH_POSTALCODE="L5M7E6" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="945978" SCH_NAME="Streetsville Secondary School" lat="43.5792" lng="-79.7192" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="72 Joymar Dr" SCH_CITY="Mississauga" SCH_POSTALCODE="L5M1G3" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="948187" SCH_NAME="T. L. Kennedy Secondary School" lat="43.5815" lng="-79.6206" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="3100 Hurontario St" SCH_CITY="Mississauga" SCH_POSTALCODE="L5B1N7" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="954403" SCH_NAME="The Woodlands Secondary School" lat="43.5629" lng="-79.6478" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="3225 Erindale Station Rd" SCH_CITY="Mississauga" SCH_POSTALCODE="L5C1Y5" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="951404" SCH_NAME="West Credit Secondary School" lat="43.586" lng="-79.7465" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="6325 Montevideo Rd" SCH_CITY="Mississauga" SCH_POSTALCODE="L5N4G7" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="823953" SCH_NAME="St Martin Secondary School" lat="43.5566" lng="-79.6356" SCH_BUILDINGSUTE="Streetsville Campus" SCH_POBOX="00" SCH_STREET="2470 Rosemary Dr" SCH_CITY="Mississauga" SCH_POSTALCODE="L5C1X2" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="806919" SCH_NAME="St Joseph Secondary School" lat="43.5897" lng="-79.6993" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="5555 Creditview Rd" SCH_CITY="Mississauga" SCH_POSTALCODE="L5V2B9" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="792594" SCH_NAME="St Francis Xavier Secondary School" lat="43.6125" lng="-79.6638" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="50 Bristol Rd W" SCH_CITY="Mississauga" SCH_POSTALCODE="L5R3K3" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="696056" SCH_NAME="St. Joan of Arc Catholic Secondary School" lat="43.5531" lng="-79.7466" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="3801 Thomas St" SCH_CITY="Mississauga" SCH_POSTALCODE="L5M7G2" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="821381" SCH_NAME="St Marcellinus Secondary School" lat="43.6241" lng="-79.7102" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="730 Courtneypark Dr W" SCH_CITY="Mississauga" SCH_POSTALCODE="L5W1L9" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="938009" SCH_NAME="Rick Hansen Secondary School" lat="43.5889" lng="-79.6832" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="1150 Dream Crest Road" SCH_CITY="Mississauga" SCH_POSTALCODE="L5V1N6" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="767255" SCH_NAME="St Aloysius Gonzaga Secondary School" lat="43.5564" lng="-79.7173" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="2800 Erin Centre Blvd" SCH_CITY="Mississauga" SCH_POSTALCODE="L5M6R5" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="925535" SCH_NAME="Mississauga Secondary School" lat="43.6251" lng="-79.7029" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="550 Courtneypark Dr. West" SCH_CITY="Mississauga" SCH_POSTALCODE="L5W1L9" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="924008" SCH_NAME="Lorne Park Secondary School" lat="43.5315" lng="-79.6247" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="1324 Lorne Park Rd" SCH_CITY="Mississauga" SCH_POSTALCODE="L5H3B1" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="798118" SCH_NAME="Loyola Catholic Secondary School" lat="43.5428" lng="-79.6878" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="3566 South Common Crt" SCH_CITY="Mississauga" SCH_POSTALCODE="L5L2B1" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="932060" SCH_NAME="Oakville Trafalgar High School" lat="43.4729" lng="-79.6548" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="1460 Devon Rd" SCH_CITY="Oakville" SCH_POSTALCODE="L6J3L6" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="958431" SCH_NAME="Peel Alternative South ISR" lat="43.591017" lng="-79.640294" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="1239 Lakeshore Road East RD" SCH_CITY="MISSISSAUGA" SCH_POSTALCODE="L5E1G2" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="954252" SCH_NAME="Peel Alternative West" lat="43.582" lng="-79.7573" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="6975 Meadowvale Town Centre Circle" SCH_CITY="Mississauga" SCH_POSTALCODE="L5N2W7" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="933672" SCH_NAME="Peel Alternative West ISR" lat="43.582" lng="-79.7573" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="6975 Meadowvale Town Centre Circle" SCH_CITY="MISSISSAUGA" SCH_POSTALCODE="L5N2W7" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="751430" SCH_NAME="Philip Pocock Catholic Secondary School" lat="43.6248" lng="-79.6258" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="4555 Tomken Rd" SCH_CITY="Mississauga" SCH_POSTALCODE="L4W1J9" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="742333" SCH_NAME="Our Lady of Mount Carmel Secondary School" lat="43.5746" lng="-79.7719" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="3700 Trelawny Circle" SCH_CITY="Mississauga" SCH_POSTALCODE="L5N5J7" SCH_TYPE_DESC="Catholic" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
<marker SCH_NO="925551" SCH_NAME="Meadowvale Secondary School" lat="43.5779" lng="-79.7613" SCH_BUILDINGSUTE="00" SCH_POBOX="00" SCH_STREET="6700 Edenwood Dr" SCH_CITY="Mississauga" SCH_POSTALCODE="L5N3B2" SCH_TYPE_DESC="Public" SCH_LANGUAGE_DESC="English" FDELP_Flag="NO"/>
 
</schools> 

XML;
       ini_set("log_errors", 1);
       ini_set("error_log", "/tmp/php-error.log");


//$oXML = new SimpleXMLElement($xmlOrig);
$xml = simplexml_load_string($xmlOrig) or die("Error: Cannot create object");
foreach($xml->children() as $school) { 
    echo $school['SCH_NO'] . ", "; 
    echo $school['SCH_NAME'] . "br "; 
} 
?>
