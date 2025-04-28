function ianseoData(participants) {
    const TAB = "\t";
    return participants
        .filter(participant => participant.athlete !== null)
        .map(participant =>
            participant.id + TAB +
            "" + TAB +
            participant.division_code + TAB +
            participant.class_code + TAB +
            "" + TAB +
            "1" + TAB +
            (participant.participate_teams ? "1" : "0") + TAB +
            "1" + TAB +
            (participant.participate_teams ? "1" : "0") + TAB +
            (participant.participate_mixed_teams ? "1" : "0") + TAB +
            participant.athlete.surname + TAB +
            participant.athlete.first_name + TAB +
            participant.athlete.patronymic + TAB +
            participant.gender + TAB +
            participant.athlete.region.code + TAB +
            participant.athlete.region.full_name + TAB +
            participant.birth_date + TAB +
            participant.athlete.qualification.code + TAB +
            (participant.sport_school !== null ? participant.sport_school.code : "") + TAB +
            (participant.sport_school !== null ? participant.sport_school.full_title : "") + TAB +
            (participant.sport_organisation !== null ? participant.sport_organisation.code : "") + TAB +
            (participant.sport_organisation !== null ? participant.sport_organisation.full_title : "") + TAB
        ).reduce((exportData, row) => exportData + "\n" + row, "");
}

export async function ianseoExportToFile(participants) {
    var data = new Blob([ianseoData(participants)], {type: 'text/plain'});
    var tempLink = document.createElement("a");

    tempLink.setAttribute('href', URL.createObjectURL(data));
    tempLink.setAttribute('download', `ianseo_participants.txt`);
    tempLink.click();

    URL.revokeObjectURL(tempLink.href);
}
