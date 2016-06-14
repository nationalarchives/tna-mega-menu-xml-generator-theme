TNA mega-menu xml generator theme
=================================

This is an ultra-minimal theme with the only sole purpose is to create a xml file for the mega-menu navigation.....


Getting Started
---------------

1. Install the theme to your multisite as a child site, or to a standalone wordpress install.
2. Create your links categories as per [TNA](http://www.nationalarchives.gov.uk/) web site.
    * `About Us`
    * `Education`
    * `Help with your research`
    * `Information management`
    * `Archives sector`
    * `More...`
3. Create the links and assign them to the categories you have created above.


Promotional banner
------------------

Adding a promotional banner to the mega-menu, would require a link category `promotional-baner`.
Once the category has been created, add a new link and asign it to the `promotional-banner` category.
Add your promotional image url to the `description field`.


Generating the XML
------------------

Run the home-page, and in the root folder you will notice a file being created, `mega_menu_data.xml`.
Note: If you wold like to make changes to the mage menu, you will need to run the home page each time for a new xml to be generated.