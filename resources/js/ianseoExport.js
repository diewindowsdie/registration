import dayjs from "dayjs";
import {translit} from 'gost-transliteration';
import {trans} from "laravel-vue-i18n";

export function ianseoData(toExport, transliterate = false) {
    const TAB = "\t";
    return toExport
        .filter(participant => participant.athlete !== null)
        .map((participant) => {
            //проверим, выбрана ли спортшкола из списка
            let sport_school_code = participant.sport_school !== null
                ? participant.sport_school.code
                : "";
            let sport_school_name = participant.sport_school !== null
                ? participant.sport_school.full_title
                : "";
            //если введено произвольное название спортшколы - берем в качестве кода первые символы названия
            if (participant.sport_school_or_club !== null) {
                sport_school_code = participant.sport_school_or_club.substring(0, 6).trim();
                sport_school_name = participant.sport_school_or_club;
            }

            //todo если решим транслитерировать названия, раскомментировать
            // if (transliterate) {
            //     sport_school_name = translit(sport_school_name);
            // }

            return participant.id + TAB +
                "" + TAB +
                participant.division_code + TAB +
                participant.class_code + TAB +
                "" + TAB +
                "1" + TAB +
                participant.participate_teams + TAB +
                "1" + TAB +
                participant.participate_teams + TAB +
                participant.participate_mixed_teams + TAB +
                (transliterate ? translit(participant.athlete.surname) : participant.athlete.surname) + TAB +
                (transliterate ? translit(participant.athlete.first_name) : participant.athlete.first_name) + TAB +
                (participant.athlete.patronymic !== null
                    ? (transliterate
                        ? translit(participant.athlete.patronymic)
                        : participant.athlete.patronymic)
                    : "") + TAB +
                participant.athlete.gender + TAB +
                participant.region_code + TAB +
                (participant.region.is_country
                    ? trans("countries." + participant.region_code)
                    : trans("regions." + participant.region_code)) + TAB +
                dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") + TAB +
                participant.athlete.qualification.code + TAB +
                sport_school_code + TAB +
                sport_school_name + TAB +
                (participant.sport_organisation !== null ? participant.sport_organisation.code : "") + TAB +
                //todo если решим транслитерировать названия, убрать false
                (participant.sport_organisation !== null
                    ? (false
                        ? translit(participant.sport_organisation.full_title)
                        : participant.sport_organisation.full_title)
                    : "") + TAB + "\n" +
                "##WHEELCHAIR##" + TAB + participant.id + TAB + (participant.athlete.using_chair ? "1" : "0");
        }).reduce((exportData, row) => exportData + row + "\n", "");
}

export async function ianseoExportToFile(participants, competitionCode, divisionAndClassCode = null, transliterate = false) {
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
