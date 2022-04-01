function saveActivity(dest) {

    if (activity != null) {
        var data = [];


        var name = "" + document.getElementById('activityName').value;

        data['name'] = name; //document.getElementById('activityName').value;

        data['difficulty'] = document.getElementById('activityDifficulty').value;
        //data['antecedent'] = document.getElementById('antecedent').value;
        //data['behavior'] = document.getElementById('behavior').value;
        //data['consequence'] = document.getElementById('consequence').value;
        data['id'] = activity.id;
        //var xhr = new XMLHttpRequest();
        //xhr.onreadystatechange = function() {
        //    if (this.readyState != 4)
        //        return;

        //    if (this.status == 200) {
        //        var ret = this.responseText;

        //        activity.saveActivity(dest);
        //    }
        //};
        console.log(data);
        var str_json = JSON.stringify(Object.assign({}, data));
        activity.saveActivity(dest, "", str_json);


        //xhr.open("POST", '<?php echo BASE_URL; ?>/activity/index.php?action=updateMetadata', true);
        //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
        //xhr.send("metadata=" + str_json);



    } else {
        alert("Erro salvando atividade. Contate o administrador");
    }
}

function hideEdit() {
    document.getElementById('edit').classList.add('d-none');
    document.getElementById('menu').classList.remove('d-none');
    document.getElementById('activityInfo').classList.remove('d-none');

    document.getElementById('editableInstructionsRow').classList.remove('d-none');
}

function showEditor(inst_number) {
    activity.instructionBeingEdited = inst_number;
    G_instruction = activity.instructions[inst_number];
    createEditor(activity.instructions[inst_number]);
    document.getElementById('editableInstructionsRow').classList.add('d-none');
    document.getElementById('menu').classList.add('d-none');
    document.getElementById('edit').classList.remove('d-none');
    document.getElementById('activityInfo').classList.add('d-none');
    resize();
}

/**
 * Adds a button to edit an instruction attribute
 * @param {type} inst
 * @param {type} attr
 * @param {type} attrType
 * @param {type} val
 * @param {type} min
 * @param {type} max
 * @returns {undefined}
 */
function addEditButton(inst, attr_descriptor) { //, attrType,edit, description, val){                
    var button = document.createElement('button');


    button.id = "button_edit_" + attr_descriptor.attributeName;

    button.classList.add('btn', 'btn-primary', 'btn-lg', 'btn-block');
    button.type = "button";
    button.innerHTML = attr_descriptor.attributeDescription;

    var buttonCol = document.createElement('div');
    buttonCol.classList.add('col');
    buttonCol.appendChild(button);

    var buttonRow = document.createElement('div');
    buttonRow.classList.add('row');

    button.onclick = function() {
        this.blur();

        editAttribute(inst, attr_descriptor);
    };


    var col = document.createElement('div');
    col.classList.add('col');

    var row = document.createElement('div');
    row.classList.add('row', 'p-2');



    buttonRow.appendChild(buttonCol);


    col.appendChild(buttonRow);
    row.appendChild(col);
    document.getElementById("controls").appendChild(row);
}
/**
 * Adds the buttons to open each instruction editor.
 * @param {type} instruction instruction unic ID (numbr
 * @returns {undefined}
 */
function createEditor(instruction) {
    document.getElementById("controls").innerHTML = "";
    var att = instruction.editableAttributes;
    document.getElementById("editInstructionName").innerHTML = instruction.description;
    var i;
    for (i = 0; i < att.length; i++) {
        addEditButton(instruction, att[i]);
    }
}






/**********************NEW**************************************/
function editAttribute(instruction, attr_descriptor) {


    G_attr_descriptor = attr_descriptor;
    var attr_desc = attr_descriptor;
    attr_desc.attributeTypes;
    if (attr_desc.attributeTypes.length > 0) {
        if (attr_desc.attributeTypes.length == 1 && attr_desc.attributeTypes[0] == 'boolean') {
            editBoolean(instruction, attr_descriptor);
            return;
        } else if (attr_desc.attributeTypes.length == 1 && attr_desc.attributeTypes[0] == 'integer') {
            editInteger(instruction, attr_descriptor);
            return;
        } else if (attr_desc.attributeTypes.length == 1 && attr_desc.attributeTypes[0] == 'text') {
            editText(instruction, attr_descriptor);
            return;
        } else if (attr_desc.attributeTypes.length == 1 && attr_desc.attributeTypes[0] == 'callFunction') {
            //throw new Error('add position');
            instruction[attr_desc.attributeEditType]();
            return;
        } else if (attr_desc.attributeTypes.length == 1 && attr_desc.attributeTypes[0] == 'selection') {
            ///Cria um seletor com dropdown
            editSelection(instruction, attr_descriptor);
            return;
        } else if (attr_desc.attributeTypes.length == 1 && attr_desc.attributeTypes[0] == 'color') {
            ///Cria um seletor para cor
            editColor(instruction, attr_descriptor);
            return;
        } else { //search in database or locally.
            //if user can add text
            editStimuli(instruction, attr_descriptor);
            return;
        }
    }
}

function createSelectStimuliContainer(types, instruction, attr_descriptor, showMore = true, showNew = true) {
    var content = document.createElement('div');
    content.id = stimuliResultDivId;
    content.classList.add('card-columns');
    var all = document.createElement('div');

    if (showNew) {
        var newStimullusButtonRow = document.createElement('div');
        newStimullusButtonRow.classList.add('row');
        var newStimulusButtonCol = document.createElement('div');
        newStimulusButtonCol.classList.add('col');
        var newStimulusButton = document.createElement('button');
        newStimulusButton.classList.add('btn', 'btn-primary', 'btn-lg', 'btn-block');
        newStimulusButton.innerHTML = "Adicionar Novo estímulo";
        newStimulusButton.onclick = function() {
            createNewStimuli(types);
        };

        all.appendChild(newStimulusButton);


    }
    var showCreateNewText = false;
    var types_arr = types.split(',');
    var t;

    for (t = 0; t < types_arr.length; t++) {
        if (types_arr[t] == 'text') {
            showCreateNewText = true;
        }
    }
    if (showCreateNewText) {
        var newTextButtonRow = document.createElement('div');
        newTextButtonRow.classList.add('row');
        var newTextButtonCol = document.createElement('div');
        newTextButtonCol.classList.add('col');
        var newTextButton = document.createElement('button');
        newTextButton.classList.add('btn', 'btn-primary', 'btn-lg', 'btn-block');
        newTextButton.innerHTML = "Adicionar Novo Texto";
        newTextButton.onclick = function() {
            addNewText(instruction, attr_descriptor);
        };

        all.appendChild(newTextButton);
    }


    var showCreateNewVideo = false;
    types_arr = types.split(',');
    t;

    for (t = 0; t < types_arr.length; t++) {
        if (types_arr[t] == 'video') {
            showCreateNewVideo = true;
        }
    }
    if (showCreateNewVideo) {
        var newTextButtonRow = document.createElement('div');
        newTextButtonRow.classList.add('row');
        var newTextButtonCol = document.createElement('div');
        newTextButtonCol.classList.add('col');
        var newTextButton = document.createElement('button');
        newTextButton.classList.add('btn', 'btn-primary', 'btn-lg', 'btn-block');
        newTextButton.innerHTML = "Adicionar Vídeo";
        newTextButton.onclick = function() {
            addNewVideo(instruction, attr_descriptor);
            //addNewText(instruction, attr_descriptor);
        };

        all.appendChild(newTextButton);
    }


    var filter = document.getElementById("filterFormTemplate").cloneNode(true);
    filter.id = G_filter_id;
    filter.classList.remove('d-none');
    all.appendChild(filter);
    all.appendChild(content);

    if (showMore) {
        var showMoreDiv = document.createElement('div');
        var showMoreButton = document.createElement('button');
        showMoreButton.classList.add('btn', 'btn-primary', 'btn-lg', 'btn-block');
        showMoreButton.innerHTML = "Carregar Mais Resultados";
        //showMoreButton.disabled = true;
        showMoreDiv.appendChild(showMoreButton);
        all.appendChild(showMoreDiv);
        showMoreButton.id = showMoreButtonId;
    }
    return all;
}

function addNewVideo(instruction, attr_descriptor) {
    //throw new Error("add new text");
    var params = [];
    params['type'] = 'video';
    instruction.setAttributeValue(attr_descriptor, "", params);
    closeModal();
}
/**
 * Cria um modal com os tipos de estímulos que o usuário pode selecionar
 * @param {type} ints
 * @param {type} attr
 * @returns {undefined}     */
function showSelectStimuli_createModal(types, instruction, attr_descriptor) {



    if (attr_descriptor.attributeTypes.length == 1 && attr_descriptor.attributeTypes[0] == 'stimulusID') {
        var container = createSelectStimuliContainer(types, instruction, attr_descriptor, false, false);
        showModal("Selecionar Estímulo", container, null, false);
        showSelecLocalStimuli(types, instruction, attr_descriptor, [instruction[attr_descriptor.attributeName]]);

    } else {
        var container = createSelectStimuliContainer(types, instruction, attr_descriptor, true, true);
        showModal("Selecionar Estímulo", container, null, false);
        showSelectStimuli(types, '', instruction, attr_descriptor);
    }
}


function showSelecLocalStimuli(types, instruction, attr_descriptor) {
    var exclude = [];
    var i;
    for (i = 0; i < instruction.ignoreInLocalSearch.length; i++) {
        exclude.push(instruction[instruction.ignoreInLocalSearch[i]]);
    }
    for (var key in instruction.idStimulis) {
        var obj = instruction.idStimulis[key];
        if (!exclude.includes(obj.localID)) {
            addLocalStimulus(obj, instruction, attr_descriptor);
        }

    }
}

function showSelectStimuli(types, query, instruction, attr_descriptor) {
    var xhttp = new XMLHttpRequest();
    //get stimulis
    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText.length <= 0) {
                console.log("lascou-se");
            } else {
                document.getElementById(showMoreButtonId).disabled = false;
                console.log(this.responseText);
                if (this.responseText == "STIMULI_NOT_FOUND") {
                    console.log("nao existe");
                    document.getElementById(showMoreButtonId).disabled = true;
                    return;
                }

                var objs = JSON.parse(this.responseText, true);
                if (objs['results'].length <= 0)
                    document.getElementById(showMoreButtonId).disabled = true;


                ///configures the 'show more results' button.
                document.getElementById(showMoreButtonId).onclick = function() {
                    showSelectStimuli(types, query, instruction, attr_descriptor);
                };

                //present stimuli
                for (key in objs['results']) {
                    var obj = objs['results'][key];
                    addStimulus(obj, instruction, attr_descriptor);

                }
                if (hint) {
                    if (selNumber == 0) {
                        askToPerformTour_2();
                    } else {
                        askToPerformTour_4();
                    }
                }

            }
        }
    };

    var d = document.getElementById(stimuliResultDivId); // where the stimulis go
    var offset = countSons(d);

    xhttp.open("GET", "../stimuli/index.php?action=get_as_json&types=" + types + "&query=" + query + "&offset=" + offset, true);
    xhttp.send();
}

function countSons(element) {

    var activities = element.childNodes;
    var num = 0;
    for (var i = 0; i < activities.length; i++) {
        if (activities[i].nodeType != Node.TEXT_NODE) {
            num++;
        }
    }
    return num;
}

function addLocalStimulus(stimulus, instruction, attr_descriptor, params = null) {
    //console.log(stimulus);
    var card = document.createElement('div');
    card.classList.add('card');

    var cardBody = document.createElement('div');
    cardBody.classList.add('card-body');

    var cardButton = document.createElement('button');
    cardButton.classList.add('btn', 'btn-primary');

    cardButton.innerHTML = "Selecionar";

    var stimuliHTML = null;



    if (stimulus.type == 'image' || stimulus.type == 'ImageStimulus') {
        console.log('local image');
        stimuliHTML = document.createElement('img');
        stimuliHTML.src = document.getElementById(stimulus.id).src; //stimuliAssocArray['data'];
        stimuliHTML.id = stimulus.localID; //stimuliAssocArray['id'];

    } else if (stimulus.type == "audio" || stimulus.type == 'AudioStimulus') {
        stimuli = document.createElement('audio');
        stimuli.controls = true;
        var source = document.createElement('source');
        source.src = "<?php echo BASE_URL; ?>" + "/" + stimuliAssocArray['url'];

        stimuli.id = stimuliAssocArray['id'];

        stimuli.appendChild(source);
    } else if (stimulus.type == "video") {
        throw new Error('editActivity.php/addStimulus: video');
    } else if (stimulus.type == "text") {
        stimuliHTML = document.createElement('div');
        stimuliHTML.innerHTML = stimulus.text;
        stimuliHTML.style.color = stimulus.fontColor;
        stimuliHTML.id = stimulus.localID;

    }



    stimuliHTML.classList.add('card-img-top');
    if (attr_descriptor != null) {

        cardButton.id = "select_stimuli_btn_" + stimuliHTML.id;

        cardButton.onclick = function() {
            var params = [];
            params['type'] = "stimulusID";
            instruction.setAttributeValue(attr_descriptor, stimuliHTML.id, params);
            //instruction.setAttributeValue(attr_descriptor,stimuli.id, params);
            closeModal();
        };
    } else {

        cardButton.onclick = function() {
            setContainerID(params['dest'], stimuliHTML.id);
            console.log("<<<<<<<<<<<<contID: " + stimulus.containerID);
        };

    }



    var localId = document.createElement("p");
    localId.innerHTML = "<b> Identificador: " + stimulus.getPosition() + "</b>";



    cardBody.appendChild(stimuliHTML);
    cardBody.appendChild(localId);
    cardBody.appendChild(cardButton);
    card.appendChild(cardBody);

    var d = document.getElementById(stimuliResultDivId);
    if (d != null) {
        d.appendChild(card);
    }
}

function addStimulus(stimuliAssocArray, instruction, attr_descriptor, local = false) {
    var stimuli = null;
    var params = [];

    var card = document.createElement('div');
    card.classList.add('card');
    //card.style.widtg = "18rem";

    var cardBody = document.createElement('div');
    cardBody.classList.add('card-body');

    var cardTitle = document.createElement('div');
    cardTitle.classList.add('card-title');
    cardTitle.innerHTML = stimuliAssocArray['name'];

    var cardText = document.createElement("div");
    cardText.classList.add('card-text');
    cardText.innerHTML = stimuliAssocArray['description'];

    var cardButton = document.createElement('button');
    cardButton.classList.add('btn', 'btn-primary');
    cardButton.innerHTML = "Selecionar";

    cardButton.id = "select_stimuli_btn_" + stimuliAssocArray['id'];
    console.log("id: " + cardButton.id);

    if (stimuliAssocArray['type'] == 'image') {
        stimuli = document.createElement('img');

        stimuli.src = stimuliAssocArray['data'];
        stimuli.id = stimuliAssocArray['id'];

    } else if (stimuliAssocArray['type'] == "audio") {
        stimuli = document.createElement('audio');
        stimuli.controls = true;
        var source = document.createElement('source');
        source.src = "<?php echo BASE_URL; ?>" + "/" + stimuliAssocArray['url'];

        stimuli.id = stimuliAssocArray['id'];

        stimuli.appendChild(source);
    } else if (stimuliAssocArray['type'] == "video") {
        throw new Error('editActivity.php/addStimulus: video');
    }

    stimuli.classList.add('card-img-top');


    cardButton.onclick = function() {
        console.log(instruction);
        if (typeof instruction == 'number')
            activity.instructions[instruction].setAttributeValue(attr_descriptor, stimuli.id, stimuliAssocArray);
        else
            instruction.setAttributeValue(attr_descriptor, stimuli.id, stimuliAssocArray);
        //instruction.setAttributeValue(attr_descriptor,stimuli.id, params);
        console.log('inst: ' + instruction + " id: " + stimuli.id);
        closeModal();
    };




    cardBody.appendChild(cardTitle);
    cardBody.appendChild(stimuli);
    cardBody.appendChild(cardText);
    cardBody.appendChild(cardButton);
    card.appendChild(cardBody);

    var d = document.getElementById(stimuliResultDivId);
    if (d != null) {
        d.appendChild(card);
    }


}


//verifyes the stimuli types.
function editStimuli(instruction, attr_descriptor) {
    console.log("editStimuli()");
    var types = "";
    var i;
    for (i = 0; i < attr_descriptor.attributeTypes.length; i++) {
        types = types + attr_descriptor.attributeTypes[i];
        if (i < attr_descriptor.attributeTypes.length - 1)
            types = types + ',';
    }
    G_types = types;
    console.log("types: '" + types + "'");
    console.log()
    showSelectStimuli_createModal(types, instruction, attr_descriptor);

}

///cria um modal com um checkbox.
function editBoolean(instruction, attr_descriptor) {

    console.log('editBoolean()');

    var form = document.createElement('form');
    form.classList.add('form-inline', 'mx-auto');

    var checkDiv = document.createElement('div');
    checkDiv.classList.add('form-check');

    var checkBox = document.createElement('input');
    checkBox.classList.add('form-check-input');
    checkBox.id = 'chkBox';
    checkBox.type = 'checkbox';
    if (instruction[attr_descriptor.attributeName] == true) {
        checkBox.checked = true;
    }

    checkBox.onchange = function() {
        var params = [];
        params['type'] = 'boolean';
        instruction.setAttributeValue(attr_descriptor, this.checked, params);
    };

    var checkLabel = document.createElement('label');
    checkLabel.classList.add('form-check-label');
    checkLabel.for = 'chkBox';
    checkLabel.innerHTML = attr_descriptor.attributeDescription;

    checkDiv.appendChild(checkBox);
    checkDiv.appendChild(checkLabel);

    form.appendChild(checkDiv);

    showModal("Selecionar audio", form, null, false);

}

function editColor(instruction, attr_descriptor) {

    console.log('editColor()');
    console.log(attr_descriptor.selectValues);

    var form = document.createElement('form');
    form.classList.add('form-inline', 'mx-auto');

    var formGroup = document.createElement('div');
    formGroup.classList.add('form-group');

    var colorInput = document.createElement('input');
    colorInput.classList.add('form-control','input-lg');
    colorInput.style.width="60px";
    colorInput.type="color";
    colorInput.id = 'colorInput';
   

    colorInput.value = instruction[attr_descriptor.attributeName];

    var label = document.createElement('label');
    label.for = "colorInput";
    label.innerHTML = attr_descriptor.attributeDescription;

    var okButton = document.createElement('button');
    okButton.innerHTML = "OK";
    okButton.type = 'button';
    okButton.classList.add('btn', 'btn-primary');



    okButton.onclick = function() {
        var val = (document.getElementById('colorInput').value);
        var params = [];
        params['type'] = 'string';
        instruction.setAttributeValue(attr_descriptor, val, params);
        closeModal();
    };

    formGroup.appendChild(label);

    formGroup.appendChild(colorInput);

    form.appendChild(formGroup);
    form.appendChild(okButton);



    showModal("Selecionar " + attr_descriptor.attributeDescription, form, null, false);

}

/**
 * Abre um modal com um seletor dropdown.
 */
function editSelection(instruction, attr_descriptor) {

    console.log('esditSelection()');
    console.log(attr_descriptor.selectValues);

    var form = document.createElement('form');
    form.classList.add('form-inline', 'mx-auto');

    var formGroup = document.createElement('div');
    formGroup.classList.add('form-group');

    var selectInput = document.createElement('select');
    selectInput.classList.add('form-control');
    selectInput.id = 'selectInput';
    for (var i = 0; i < attr_descriptor.selectValues.length; i++) {
        var val = attr_descriptor.selectValues[i];
        var opt = document.createElement('option');
        opt.value = val[0];
        opt.innerHTML = val[1]
        selectInput.appendChild(opt);
    }

    selectInput.value = instruction[attr_descriptor.attributeName];

    var label = document.createElement('label');
    label.for = "selectInput";
    label.innerHTML = attr_descriptor.attributeDescription;

    var okButton = document.createElement('button');
    okButton.innerHTML = "OK";
    okButton.type = 'button';
    okButton.classList.add('btn', 'btn-primary');



    okButton.onclick = function() {
        var val = (document.getElementById('selectInput').value);
        var params = [];
        params['type'] = 'string';
        instruction.setAttributeValue(attr_descriptor, val, params);
        closeModal();
    };

    formGroup.appendChild(label);
    formGroup.appendChild(selectInput);

    form.appendChild(formGroup);
    form.appendChild(okButton);



    showModal("Selecionar " + attr_descriptor.attributeDescription, form, null, false);

}

function editInteger(instruction, attr_descriptor) {

    console.log('editInteger()');

    var form = document.createElement('form');
    form.classList.add('form-inline', 'mx-auto');

    var formGroup = document.createElement('div');
    formGroup.classList.add('form-group');

    var numberInput = document.createElement('input');
    numberInput.classList.add('form-control');
    numberInput.type = "number";
    numberInput.id = 'numberInput';
    numberInput.value = instruction[attr_descriptor.attributeName];

    var label = document.createElement('label');
    label.for = "numberInput";
    label.innerHTML = attr_descriptor.attributeDescription;

    var okButton = document.createElement('button');
    okButton.innerHTML = "OK";
    okButton.type = 'button';
    okButton.classList.add('btn', 'btn-primary');



    okButton.onclick = function() {
        var val = parseInt(document.getElementById('numberInput').value);
        var params = [];
        params['type'] = 'integer';
        instruction.setAttributeValue(attr_descriptor, val, params);
        closeModal();
    };

    formGroup.appendChild(label);
    formGroup.appendChild(numberInput);

    form.appendChild(formGroup);
    form.appendChild(okButton);



    showModal("Selecionar audio", form, null, false);

}


function addNewText(instruction, attr_descriptor) {

    //throw new Error("add new text");
    var params = [];
    params['type'] = 'text';
    instruction.setAttributeValue(attr_descriptor, "Mudei", params);
    closeModal();
}


function showEditText(instruction, attr_descriptor) {}

function createNewStimuli(types) {

    var labels = [];
    labels['image'] = "Imagem";
    labels['audio'] = "Áudio";
    labels['video'] = "Vídeo";

    var all = genNewStimuliForm(types.split(','), labels);
    swapModalContent(all);
    modal_changeType();
}

function filter() {
    document.getElementById(stimuliResultDivId).innerHTML = "";
    var query = document.getElementById('search').value;



    showSelectStimuli(G_types, query, G_instruction, G_attr_descriptor);
}


/******************************************************************/
/**
 * Realiza a busca ao apertar 'enter' no campo de busca.
 * @param {type} e
 * @returns {undefined}
 */
function filterKeyUp(e) {
    var keynum;

    if (window.event) { // IE                    
        keynum = e.keyCode;
    } else if (e.which) { // Netscape/Firefox/Opera                   
        keynum = e.which;
    }
    if (keynum == 13)
        filter();
}


var config_form_id = "oiuioawgf";

function configureStimulusCallback_submit(stimulus, inst) {

    if (stimulus.type == 'text') {
        stimulus.text = document.forms[config_form_id]["text-value"].value;
        stimulus.fontSize = parseInt(document.forms[config_form_id]["text-fontSize"].value);
        console.log("font siz " + stimulus.fontSize)
        stimulus.fontColor = document.forms[config_form_id]["text-color"].value;
    } else if (stimulus.type == 'image') {
        throw new Error('image.');
    } else if (stimulus.type == 'audio') {
        throw new Error('audio.');
    } else if (stimulus.type == 'video') {
        var url = document.forms[config_form_id]["video-url"].value;
        if (!url.includes("youtube.com", 0) && !url.includes("youtu.be", 0)) {
            alert("Insira uma URL do youtube válida! (copie o endereço do vídeo)");
            return;
        }
        stimulus.setURL(url);
    }


    closeModal();
}

function setContainerID(stimulus, id) {

    stimulus.containerID = id;
    console.log(stimulus);
    closeModal();
}

function showSelecStimuliContainer(stimulus, obj_array, instruction) {

    var i;
    console.log(obj_array);
    for (i = 0; i < obj_array.length; i++) {

        var obj = obj_array[i];
        console.log("***********************************************************");
        console.log(obj.localID);
        var f = function() {
            console.log("=-=-=-===-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=");
            console.log('localID: ' + obj.localID);
            //    setContainerID(stimulus, obj);

        };

        if (!obj.fullContainer) {


            addLocalStimulus(obj, instruction, null, {
                'dest': stimulus
            });
        }

    }
}

function containerConfigureFull(stimulus) {
    console.log('editBoolean()');

    var form = document.createElement('form');
    form.classList.add('form-inline', 'mx-auto');

    var checkDiv = document.createElement('div');
    checkDiv.classList.add('form-check');

    var checkBox = document.createElement('input');
    checkBox.classList.add('form-check-input');
    checkBox.id = 'chkBox';
    checkBox.type = 'checkbox';
    if (stimulus.fullContainer) {
        checkBox.checked = true;
    }

    checkBox.onchange = function() {
        stimulus.fullContainer = this.checked;
    };

    var checkLabel = document.createElement('label');
    checkLabel.classList.add('form-check-label');
    checkLabel.for = 'chkBox';
    checkLabel.innerHTML = "Cheio? (não permite adicionar estímulos)";

    checkDiv.appendChild(checkBox);
    checkDiv.appendChild(checkLabel);

    form.appendChild(checkDiv);

    showModal("Contener cheio? (não pode adicionar estímulos)", form, null, false);
}

//Callback chamada ao clicar na configuração do estímulo (engrenagem)
function configureStimulusCallback(stimulus, inst) {


    var content = "Sem atributos para editar.";
    ///Get form..
    console.log("TYPE: " + stimulus.type);
    if (stimulus.hasOwnProperty('emotionDescriptor')) {
        //TODO: selecioanr emoção aqui 
        showSelectEmotion(stimulus);
        return;

    } else if (stimulus.type == "text") {
        content = document.getElementById('imagePropsTemplate').cloneNode(true);
    } else if (stimulus.type == "video") {
        content = document.getElementById('videoPropsTemplate').cloneNode(true);
    } else if (stimulus.type == 'image') {
        if (stimulus.dragAndAssociate == true) {
            var container = createSelectStimuliContainer('image', stimulus.instruction, null, false, false);
            showModal("Selecione o conteiner correto para o estimulo", container, null, false);
            showSelecStimuliContainer(stimulus, stimulus.instruction.positions, stimulus.instruction);
            return;
        } else if (stimulus.isContainer) {

            containerConfigureFull(stimulus);
            return;
        }

        showModal("Configurar Estímulo", "Sem atributos para editar.");
    }
    content.hidden = false;
    content.id = config_form_id;

    showModal("Configurar Estímulus", content, function() {
        configureStimulusCallback_submit(stimulus, inst);
    }, true);
    if (stimulus.type == 'text') {
        document.forms[config_form_id]["text-value"].value = stimulus.text;
        document.forms[config_form_id]["text-fontSize"].value = stimulus.fontSize;
        document.forms[config_form_id]["text-color"].value = stimulus.fontColor;
    }


}

function removeStimulusCallback_submit(stimulus, inst) {
    console.log(stimulus);
    console.log("Remove stimuli " + stimulus);
    console.log(inst);
    inst.removeStimuli(stimulus.localID, 'image');
    closeModal();
}

function removeStimulusCallback(stimulus, inst) {
    showModal("Remover Estímulo", "Deseja remover o estímulo?", function() {
        removeStimulusCallback_submit(stimulus, inst);
    }, true);
}

function showSelectEmotion(stimulus) {
    var content = document.getElementById('emotionDescriptorTemplate').cloneNode(true);
    content.classList.remove("d-none");
    if (stimulus.emotionDescriptor.length > 0)
        content.querySelector("#emotionDescriptorValue").value = stimulus.emotionDescriptor;
    showModal("Selecione a emoção que o estímulo representa", content, function() {
        var val = content.querySelector("#emotionDescriptorValue").value;

        stimulus.emotionDescriptor = val;
        closeModal();
    }, true);
}



/******************************************************************************************/

