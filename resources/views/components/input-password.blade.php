<div class="input-group-teks ">
    <label for="{{ $id }}" class="form-label">{{ $title }}</label>
    <div class="flex-row p-0 d-flex form-control">
        <input style="width: 100%" class="inputpassword form-control" type="password" id="{{ $id }}"
            name="{{ $name }}" required>
        <span class="input-group-text eye-icon" onclick="togglePasswordVisibility('{{ $id }}')">
            <i class="fa fa-eye" id="eye-icon-password"></i>
        </span>
    </div>
</div>
