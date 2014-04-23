Doghouse Location
=================

List your store locations in the frontend and manage them in the admin section. Blazingly fast and amazing module. Again, continuing the trend of things that make no design-decisions for you, this module doesn't actually show anything in the frontend. It just comes with an amazing backend interface.

You know what! You can use [Slick](http://kenwheeler.github.io/slick/) to show off your stores - that would look slick!

## Features

- Really nice Adminhtml grid with day of the week sorting, store location - opening hour relations, image preview and everything
- Comes free with foreign keys and all that stuff
- It doesn't do anything on the front-end. That's up to you
- You can put stuff in it in the back-end

## Installation

Install using Composer (preferred) or Modman.

## Docs

Here's a list of things you can do with it.

Getting a collection of your store locations. Wow!

`Mage::getModel('dhlocation/location')->getCollection();`

Getting a collection of your opening hours by location `$id`, and sorting them by weekday. Shet!

	Mage::getModel('dhlocation/hour')->getCollection()
		->addFieldToFilter('location_id', $id)
		->sortByWeekDay();

Showing how nice your store with `$id` is. So amaze!

	$store = Mage::getModel('dhlocation/location')->load($id);

	echo '<img src="' . Mage::helper('dhlocation')->getImage($store) . '"/>'

That's it.

## About

Created initially for ZOMP by [Erfan](mailto:erfan@dhmedia.com.au).