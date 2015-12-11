<fieldset>
    <legend>Tax Detail</legend>
    <div class="row s12">
        {{$tax->tax_name}} Tax: ${{$invoice->total_tax}}
        <br />
        @if($tax_componenets)
            @foreach($tax_componenets as $component)
            <p>{{$component->component_name}} Tax: ${{($invoice->total_tax)/(($tax_data->accumulative_rate)/100)*(($component->tax_rate)/100)}}</p>
            @endforeach
        @endif
    </div>

</fieldset>