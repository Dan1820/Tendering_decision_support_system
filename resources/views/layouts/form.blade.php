<form class="form" method="post" action="handletender" enctype="multipart/form-data">

    @csrf


    <div class="elementor-form-fields-wrapper elementor-labels-above">
        <input type="hidden" name="tender_type" value="{{$_GET['type'] ?? 'no tender'}}">
        <div
            class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-50">
            <label for="form-field-name"
                class="elementor-field-label">
                Business Name </label>
            <input size="1" type="text"
                name="business_name"
                class="elementor-field elementor-size-md  elementor-field-textual"
                placeholder="Business Name">
        </div>
        <div
            class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_dafa4dd elementor-col-50">
            <label for="form-field-field_dafa4dd"
                class="elementor-field-label">
                Registration number/ID </label>
            <input size="1" type="text"
                name="registration_no"

                class="elementor-field elementor-size-md  elementor-field-textual"
                placeholder="registration_no">
        </div>
        <div
            class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-email elementor-col-50 elementor-field-required">
            <label for="form-field-email"
                class="elementor-field-label">
                Select Financial Status </label>

                <select class="elementor-field elementor-size-md  elementor-field-textual" name="finance"  placeholder="amount" aria-required="true" required aria-label="Default select example">
                    <option value="0">Choose range:-</option>
                    <option value="1">(100,000 - 150,000)</option>
                    <option value="2">(150,000 - 200,000)</option>
                    <option value="3">(200,000 and above)</option>
                  </select>

        </div>
        <div
            class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-field_996a277 elementor-col-50 elementor-field-required">
            <label for="form-field-field_996a277"
                class="elementor-field-label">
                Capital </label>
            <input size="1" type="number"
                name="cost"

                class="elementor-field elementor-size-md  elementor-field-textual"
                placeholder="capital" required="required"
                aria-required="true">
        </div>
{{--  licence document  --}}
    <div
        class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-field_996a277 elementor-col-50 elementor-field-required">



            {{--    --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload Licence</span>
                </div>
                <div class="custom-file">
                  <input type="file" name="licence" class="custom-file-input elementor-field elementor-size-md  elementor-field-textual" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
              </div>
            {{--    --}}
    </div>

{{--  end of document  --}}

        <div
            class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_7f04e27 elementor-col-100 elementor-field-required">
            <label for="form-field-field_7f04e27"
                class="elementor-field-label">
                Date registered </label>
            <input size="1" type="text"
                name="date_registered"

                class="elementor-field elementor-size-md  elementor-field-textual"
                placeholder="01/02/2022" required="required"
                aria-required="true">
        </div>
        <div
        class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_7f04e27 elementor-col-100 elementor-field-required">

        <input size="1" type="hidden" value="1"
            name="portfolio"

            class="elementor-field elementor-size-md  elementor-field-textual"
            placeholder="1" required="required"
            aria-required="true">
    </div>

        <div
            class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-message elementor-col-100">
            <label for="form-field-message"
                class="elementor-field-label">
                Business Address:</label>
            <textarea class="elementor-field-textual elementor-field  elementor-size-md" name="business_address"
                rows="4" placeholder="location/address"></textarea>
        </div>
        <div
            class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
            <button type="submit"
                class="">
               Apply Tender
            </button>
        </div>
    </div>
</form>
