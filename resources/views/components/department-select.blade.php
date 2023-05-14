<select
    {{ $attributes->merge(["class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"]) }}>
    <option value="">Choose Department</option>
    @foreach($departments as $department)
        <option value="{{ $department->id }}">{{ $department->name }}</option>
    @endforeach
</select>