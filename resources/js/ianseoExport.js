import dayjs from "dayjs";
import {translit} from 'gost-transliteration';
import {trans} from "laravel-vue-i18n";

export function ianseoData(toExport, competition) {
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
            // if (competition.ui_language !== "ru") {
            //     sport_school_name = translit(sport_school_name);
            // }

            const firstName = (competition.ui_language !== "ru" ? translit(participant.athlete.first_name) : participant.athlete.first_name);
            const patronymic = (participant.athlete.patronymic !== null
                ? (competition.ui_language !== "ru"
                    ? translit(participant.athlete.patronymic)
                    : participant.athlete.patronymic)
                : "");

            return participant.id + TAB +
                "1" + TAB +
                participant.division_code + TAB +
                participant.class_code + TAB +
                "" + TAB +
                "1" + TAB +
                participant.participate_teams + TAB +
                "1" + TAB +
                participant.participate_teams + TAB +
                participant.participate_mixed_teams + TAB +
                (competition.ui_language !== "ru" ? translit(participant.athlete.surname) : participant.athlete.surname) + TAB +
                (competition.ui_language === "ru"
                    ? firstName + TAB + patronymic + TAB
                    : firstName + " " + patronymic + TAB
                ) +
                participant.athlete.gender + TAB +
                participant.region_code + TAB +
                (participant.region.is_country
                    ? trans("countries." + participant.region_code)
                    : trans("regions." + participant.region_code)) + TAB +
                dayjs(participant.athlete.birth_date).format("DD.MM.YYYY") + TAB +
                (competition.use_sport_qualification ? participant.athlete.qualification.code : "") + TAB +
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

export async function ianseoExportToFile(participants, competition, divisionAndClassCode = null) {
    var data = new Blob([ianseoData(participants, competition)], {type: 'text/plain'});
    var tempLink = document.createElement("a");

    var fileName = "ianseo_participants_" + competition.id + ".txt";
    if (divisionAndClassCode !== null) {
        fileName = "ianseo_participants_" + competition.id + "_" + divisionAndClassCode + ".txt";
    }
    tempLink.setAttribute('href', URL.createObjectURL(data));
    tempLink.setAttribute('download', fileName);
    tempLink.click();

    URL.revokeObjectURL(tempLink.href);
}
