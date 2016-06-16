TNA mega-menu xml generator theme
=================================

This is an ultra-minimal theme with the only sole purpose is to create a xml file for the mega-menu navigation.


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
3. Create the links and assign them to the categories you have created above
    * In the advance panel, change the rating to a number which will set the order to be appeared.
    * Do not leave the rating to 0, as it will appear in the order of the date added.
    * Be aware to not give the links the same rating.


Promotional banner
------------------

1. Adding a promotional banner to the mega-menu, will require a link category `promotional-baner`.
2. Once the category has been created, add a new link and asign it to the `promotional-banner` category.
3. Add your promotional image url to the `description field`.
4. It will not be required to give a rating for the promotional banner.
5. There can more than 2 links assigned to the `promotional-banner` category, but only the latest one will be rendered.


Generating the XML
------------------

Run the home-page, and in the root folder you will notice a file being created, `mega_menu_data.xml`.

__Note:__ If you wold like to make changes to the mage menu, you will need to run the home page each time for a new xml to be generated.