import dayjs from "dayjs";

export function ianseoData(toExport) {
    const TAB = "\t";
    return toExport
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
            participant.athlete.gender + TAB +
            participant.athlete.region.code + TAB +
            participant.athlete.region.full_name + TAB +
            dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") + TAB +
            participant.athlete.qualification.code + TAB +
            (participant.sport_school !== null ? participant.sport_school.code : "") + TAB +
            (participant.sport_school !== null ? participant.sport_school.full_title : "") + TAB +
            (participant.sport_organisation !== null ? participant.sport_organisation.code : "") + TAB +
            (participant.sport_organisation !== null ? participant.sport_organisation.full_title : "") + TAB + "\n" +
            "##WHEELCHAIR##" + TAB + participant.id + TAB + (participant.athlete.using_chair ? "1" : "0")
        ).reduce((exportData, row) => exportData + row + "\n", "");
}

export async function ianseoExportToFile(participants, competitionCode, divisionAndClassCode = null) {
    var data = new Blob([ianseoData(participants)], {type: 'text/plain'});
    var tempLink = document.createElement("a");

    var fileName = "ianseo_participants_" + competitionCode + ".txt";
    if (divisionAndClassCode !== null) {
        fileName = "ianseo_participants_" + competitionCode + "_" + divisionAndClassCode + ".txt";
    }
    tempLink.setAttribute('href', URL.createObjectURL(data));
    tempLink.setAttribute('download', fileName);
    tempLink.click();

    URL.revokeObjectURL(tempLink.href);
}
