Doghouse Location
=================

List your store locations in the frontend and manage them in the admin section. Again, continuing the trend of things that make no design-decisions for you, this module doesn't actually show anything in the frontend. It just comes with a nice backend interface.

## Features

- Really nice Adminhtml grid with day of the week sorting, store location - opening hour relations, image preview and everything
- Comes free with foreign keys and all that stuff
- It doesn't do anything on the front-end. That's up to you
- You can put stuff in it in the admin panel

## Screenshot

![Doghouse Location screenshot of admin panel](doghouse_location_screenshot.png?raw=true "Doghouse Location screenshot of admin panel")

## Installation

Install using **Composer** (preferred) or **Modman**. Don't just drag this into your project without being aware of the directory structure.

## Docs

Here's a list of things you can do with it.

Getting a collection of your store locations. Wow!

`Mage::getModel('dhlocation/location')->getCollection();`

Getting a collection of your opening hours by location `$id`, and sorting them by weekday.

	Mage::getModel('dhlocation/hour')->getCollection()
		->addFieldToFilter('location_id', $id)
		->sortByWeekDay();

Showing how nice your store with `$id` is.

	$store = Mage::getModel('dhlocation/location')->load($id);

	echo '<img src="' . $this->quoteEscape(Mage::helper('dhlocation')->getImage($store)) . '"/>'

That's it.

## About

Created by [Doghouse](http://doghouse.agency/) because we needed a user-friendly way of getting store locations in the database. It's bloat free, has plenty of events that you can listen to (if that's your thing), and can be used in any project because it doesn't output any HTML or make any design decisions for you.

# License

[MIT License](https://opensource.org/licenses/MIT)
