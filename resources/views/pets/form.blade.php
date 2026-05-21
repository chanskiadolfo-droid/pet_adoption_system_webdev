<label>Name</label>
<input type="text" name="name" value="{{ old('name', $pet->name ?? '') }}" required>

<label>Type</label>
<input type="text" name="type" value="{{ old('type', $pet->type ?? '') }}" required>

<label>Breed</label>
<input type="text" name="breed" value="{{ old('breed', $pet->breed ?? '') }}">

<label>Age</label>
<input type="number" name="age" value="{{ old('age', $pet->age ?? '') }}">

<label>Gender</label>
<select name="gender" required>
    <option value="Male" @selected(old('gender', $pet->gender ?? '') === 'Male')>Male</option>
    <option value="Female" @selected(old('gender', $pet->gender ?? '') === 'Female')>Female</option>
</select>

<label>Description</label>
<textarea name="description">{{ old('description', $pet->description ?? '') }}</textarea>

<label>Status</label>
<select name="status" required>
    <option value="available" @selected(old('status', $pet->status ?? 'available') === 'available')>Available</option>
    <option value="adopted" @selected(old('status', $pet->status ?? '') === 'adopted')>Adopted</option>
</select>
