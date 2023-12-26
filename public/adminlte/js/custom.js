const modifyElements = document.getElementById("modify-elements");
const soprTbody = document.querySelector("[data-sopr_tbody_counter]");

const modifyCount = document.querySelector("[data-modify_count]");
const modifyValueCount = document.querySelector("[data-modify_value_count]");
const modifySoprCount = document.querySelector("[data-modify_sopr_count]");

// Счетчик (названий) модификаций
let modifyGoupCounter = parseInt(modifyCount.value);
// Счетчик значений модификации
let modifyValueCounter = parseInt(modifyValueCount.value);
// Счетчик строк сопряжений
let soprCounter = parseInt(modifySoprCount.value);

window.addEventListener("click", function (event) {
    // Добавить Модификацию

    if (event.target.hasAttribute("data-modify_name_plus_btn")) {
        let div = document.createElement("div");
        div.className = "group__modify-wrapper";
        div.setAttribute(
            "data-modify_group_wrapper_counter",
            modifyGoupCounter
        );

        const selectModifyType = `<div>
				<select name="modify_type_${modifyGoupCounter}" class="custom-select form-control" id="exampleSelectBorder">
					<option value="0">Выберите модификатор</option>
					<option disabled>----- Наружное освещение -----</option>
					<option value="exlight_size">Размер</option>
					<option value="exlight_lens_type">Вид рассеивателя</option>
					<option value="exlight_color">Цвет</option>
					<option value="exlight_color_temperature">Цветовая температура</option>
					<option value="exlight_color_control">Управление светом</option>
					<option disabled>----- Панели и перегородки -----</option>
					<option value="panel_width">Ширина (см)</option>
					<option value="panel_height">Высота (см)</option>
					<option value="panel_fastener_type">Вид крепежа</option>					
					<option value="panel_color">Цвет</option>					
					<option disabled>----- Панно -----</option>
					<option value="panno_size">Размер</option>
					<option value="panno_fastener_type">Вид крепежа</option>
					<option value="panno_color">Цвет</option>
				</select>
				</div>`;
        const btnModifyNameBtns = `<div class="group__modify-name-btn-wrapper">
					<input type="button" class="btn btn-danger group__modify-name-minus-btn" value="-"
						data-modify_name_minus_btn="${modifyGoupCounter}" />

					<input type="button" class="btn btn-primary group__modify-name-plus-btn" value="+"
						data-modify_name_plus_btn="${modifyGoupCounter}" />						
				</div>`;

        const inputModifyValue = `<input type='text' name='modify_value_${modifyGoupCounter}_0' class='form-control' placeholder='Значение по умолчанию' data-modify_value='0' />`;
        const btnModifyValueBtns = `<div class="group__modify-value-btn-wrapper">
					<input type="button" class="btn btn-danger group__modify-value-minus-btn" value="-"
						data-modify_value_minus_btn="${modifyGoupCounter}" />

					<input type="button" class="btn btn-primary group__modify-value-plus-btn" value="+"
						data-modify_value_plus_btn="${modifyGoupCounter}" />
				</div>`;

        div.innerHTML =
            "<div class='group__modify-name'>" +
            selectModifyType +
            btnModifyNameBtns +
            "</div>" +
            "<div class='group__modify-value'>" +
            `<div class='group__modify-value-wrapper' data-modify_value_wrapper='${modifyGoupCounter}' data-modify_value_wrapper_counter='0'>` +
            inputModifyValue +
            "</div>" +
            btnModifyValueBtns +
            "</div>";

        modifyElements.append(div);

        // Счетчик скрытого поля модификации
        modifyCount.value = modifyGoupCounter + 1;

        // Счетчик скрытого поля значений модификации
        ++modifyValueCounter;
        modifyValueCount.value = modifyValueCounter;

        const modifyLastPlusBtn = modifyElements.querySelector(
            `[data-modify_name_plus_btn='${modifyGoupCounter - 1}']`
        );

        const modifyLastMinusBtn = modifyElements.querySelector(
            `[data-modify_name_minus_btn='${modifyGoupCounter - 1}']`
        );

        modifyLastPlusBtn.classList.add("_hidden-btn");
        modifyLastMinusBtn.classList.add("_hidden-btn");

        ++modifyGoupCounter;
    }

    // Удалить Модификацию

    if (event.target.hasAttribute("data-modify_name_minus_btn")) {
        const valueBtn = event.target.dataset.modify_name_minus_btn;

        if (valueBtn > 0) {
            const modifyGroupWrapper = modifyElements.querySelector(
                `[data-modify_group_wrapper_counter='${valueBtn}']`
            );

            --modifyGoupCounter;

            // Счетчик скрытого поля модификации
            modifyCount.value = modifyGoupCounter;

            // Счетчик скрытого поля значений модификации
            const valueWrapperCounter = modifyGroupWrapper.querySelector(
                "[data-modify_value_wrapper_counter]"
            );
            let valueCount =
                valueWrapperCounter.dataset.modify_value_wrapper_counter;
            ++valueCount;

            modifyValueCounter = modifyValueCounter - valueCount;
            modifyValueCount.value = modifyValueCounter;

            // Счетчик модификаций и удаление самой модификации
            modifyGroupWrapper.remove();
        }

        if (valueBtn != 0) {
            const modifyLastPlusBtn = modifyElements.querySelector(
                `[data-modify_name_plus_btn='${valueBtn - 1}']`
            );

            const modifyLastMinusBtn = modifyElements.querySelector(
                `[data-modify_name_minus_btn='${valueBtn - 1}']`
            );

            modifyLastPlusBtn.classList.remove("_hidden-btn");
            modifyLastMinusBtn.classList.remove("_hidden-btn");
        }
    }

    // Добавить значение к модификации

    if (event.target.hasAttribute("data-modify_value_plus_btn")) {
        const valueBtn = event.target.dataset.modify_value_plus_btn;
        const modifyValueWrp = document.querySelector(
            `[data-modify_value_wrapper='${valueBtn}']`
        );

        // Счетчик значений модификатора
        let modifyValueGroupCounter =
            modifyValueWrp.dataset.modify_value_wrapper_counter;
        modifyValueWrp.dataset.modify_value_wrapper_counter =
            ++modifyValueGroupCounter;

        let input = document.createElement("input");
        input.type = "text";
        input.name = "modify_value_" + valueBtn + "_" + modifyValueGroupCounter;
        input.className = "form-control";
        input.placeholder = "Значение";
        input.setAttribute("data-modify_value", modifyValueGroupCounter);

        modifyValueWrp.append(input);

        // Счетчик скрытого поля значений модификации
        ++modifyValueCounter;
        modifyValueCount.value = modifyValueCounter;
    }

    // Удалить значение из модификации

    if (event.target.hasAttribute("data-modify_value_minus_btn")) {
        const valueBtn = event.target.dataset.modify_value_minus_btn;
        const modifyValueWrp = document.querySelector(
            `[data-modify_value_wrapper='${valueBtn}']`
        );

        const lastInputNum =
            modifyValueWrp.dataset.modify_value_wrapper_counter;

        if (lastInputNum > 0) {
            const lastInput = modifyValueWrp.querySelector(
                `[data-modify_value='${lastInputNum}']`
            );

            lastInput.remove();

            // Счетчик значений по текущей модификации
            let modifyValueGroupCounter =
                modifyValueWrp.dataset.modify_value_wrapper_counter;
            modifyValueWrp.dataset.modify_value_wrapper_counter =
                --modifyValueGroupCounter;

            // Счетчик скрытого поля значений модификации
            --modifyValueCounter;
            modifyValueCount.value = modifyValueCounter;
        }
    }

    // Добавить сопряжение

    if (event.target.hasAttribute("data-sopr_plus_btn")) {
        let tr = document.createElement("tr");
        tr.setAttribute("data-sopr_tbody_row", soprCounter);
        const numTd = `<td><b>${soprCounter + 1}</b></td>`;
        const soprTd = `<td><input type='text' name='sopr_${soprCounter}' class='form-control sopr-input' placeholder='Сопряжение' /></td>`;
        const modelCodeTd = `<td><input type='text' name='model_${soprCounter}' class='form-control model-input' placeholder='Код модели' /></td>`;
        const articleTd = `<td><input type='text' name='article_${soprCounter}' class='form-control article-input' placeholder='Артикул' /></td>`;
        const priceTd = `<td><input type='number' name='price_${soprCounter}' min='1' class='form-control price-input' placeholder='Цена' /></td>`;
        const numImgTd = `<td><input type="number" name="num_img_${soprCounter}" min="1" class="form-control num-img-input" placeholder="# Изобр."></td>`;
        const dataTd = `<td><input type="text" name="specific_data_${soprCounter}" class="form-control specific-data-input" placeholder="Технич. данные"></td>`;
        tr.innerHTML =
            numTd +
            soprTd +
            modelCodeTd +
            articleTd +
            priceTd +
            numImgTd +
            dataTd;

        soprTbody.dataset.sopr_tbody_counter = soprCounter;
        soprTbody.append(tr);

        ++soprCounter;

        // Счетчик скрытого поля таблици сопряжений
        modifySoprCount.value = soprCounter;
    }

    // Удалить сопряжение

    if (event.target.hasAttribute("data-sopr_minus_btn")) {
        if (soprCounter > 1) {
            const lastRow = soprTbody.dataset.sopr_tbody_counter;
            const soprRow = soprTbody.querySelector(
                `[data-sopr_tbody_row='${lastRow}']`
            );

            if (soprRow != null) {
                soprRow.remove();
                --soprCounter;
                soprTbody.dataset.sopr_tbody_counter = soprCounter - 1;

                // Счетчик скрытого поля таблици сопряжений
                modifySoprCount.value = soprCounter;
            }
        }
    }
});
