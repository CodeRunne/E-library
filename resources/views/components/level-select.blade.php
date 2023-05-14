<select
    {{ $attributes->merge(["class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"]) }}>
    <option value="">Choose Department</option>
    @foreach($levels as $level)
        <option value="{{ $level->id }}">{{ $level->level }}</option>
    @endforeach
</select>