<?php

namespace Invoicing\ImageFilters;

use Intervention\Image\Filters\FilterInterface;

class InvoiceLogoImageFilter implements FilterInterface {

    /**
     * Applies filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(\Intervention\Image\Image $image)
    {
        return $image->resize(null, 200, function($constraint) {
            $constraint->aspectRatio();
        });
    }
}