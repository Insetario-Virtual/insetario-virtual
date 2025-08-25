<x-filter-form :orders="$orders" :families="$families" :cultures="$cultures" />

<x-insect-card 
    :id="$insect->id" 
    :common_name="$insect->common_name"
    :scientific_name="$insect->scientific_name"
    :image_path="$insect->image_path"
/>